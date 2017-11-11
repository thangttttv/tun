<?php
namespace App\Http\Controllers\Api\V1;

use App\Exceptions\APIErrorException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\PaginationCustomerRequest;
use App\Http\Responses\Api\V1\Feed;
use App\Http\Responses\Api\V1\Feeds;
use App\Http\Responses\Api\V1\Status;
use App\Repositories\FeedRepositoryInterface;
use App\Repositories\PageRepositoryInterface;
use App\Services\APIUserServiceInterface;
use Facebook\Facebook;
use Illuminate\Http\Request;

class FeedController extends Controller
{
    /** @var \App\Repositories\FeedRepositoryInterface */
    protected $feedRepository;

    /** @var APIUserServiceInterface */
    protected $userService;

    /** @var \App\Repositories\PageRepositoryInterface */
    protected $pageRepository;

    /** @var \Facebook\Facebook */
    protected $fb;

    public function __construct(
        FeedRepositoryInterface $feedRepository,
        APIUserServiceInterface $userService,
        PageRepositoryInterface $pageRepository
    ) {
        $this->feedRepository           = $feedRepository;
        $this->userService              = $userService;
        $this->pageRepository           = $pageRepository;
        $this->fb                       = new Facebook([
            'app_id'     => config('services.facebook.client_id'),
            'app_secret' => config('services.facebook.client_secret'),
        ]);
    }

    // get feed by conversation
    public function pullFeed(Request $request)
    {
        $fbToken          = $request->get('facebook_token');
        $facebook_page_id = $request->get('facebook_page_id');

        $subUrl = 'feed?fields=is_hidden,from,full_picture,id,is_published,is_popular,is_expired,picture
		,caption,subscribed,description,admin_creator,created_time,link,is_spherical&limit=100';
        $sdata   = $this->fb->get('/'.$facebook_page_id.'/'.$subUrl, $fbToken)->getBody();

        $conversation = \GuzzleHttp\json_decode($sdata);
        $messages     =  $conversation->data;

        $page = $this->pageRepository->findByFacebookId($facebook_page_id);
        if ($page != null) {
            foreach ($messages as $message) {
                try {
                    $feed=$this->getFeedFromJsonObject($message, $page->id);
                    $this->feedRepository->create($feed);
                } catch (\Exception $exception) {
                    echo $message->id.'----'.$exception->getMessage().'<br/>';
                }
            }

            return Status::ok()->response();
        } else {
            return Status::error('unknown', 'Page not found.')->response();
        }
    }

    public function index(PaginationCustomerRequest $request)
    {
        $offset             = $request->offset();
        $limit              = $request->limit();
        $page_id            = $request->get('page_id');
        $filters            = [];
        $filters['page_id'] = $page_id;

        $feeds   = $this->feedRepository->getByFilter($filters, $request->order(), $request->direction(), $offset, $limit + 1);
        $hasNext = false;

        if (count($feeds) > $limit) {
            $hasNext = true;
            $feeds   = $feeds->slice(0, $limit);
        }

        return Feeds::updateListWithModel($feeds, $offset, $limit, $hasNext)->response();
    }

    public function store(Request $request)
    {
        /** @var \App\Models\User $user */
        $user             = $this->userService->getUser();
        $input            = $request->only(['page_id', 'message', 'link', 'name', 'caption', 'published', 'full_picture']);
        $fbToken          = $request->get('facebook_token');
        $facebook_page_id = $request->get('facebook_page_id');

        // post feed
        try {
            $body    = $this->fb->post('/'.$facebook_page_id.'/feed', $input, $fbToken)->getBody();
            $feedRes = \GuzzleHttp\json_decode($body);

            if (isset($feedRes->id)) {
                $input['feed_facebook_id'] = $feedRes->id;
                // get feed detail
                $subUrl = '?fields=is_hidden,from,full_picture,id,is_published,is_popular,is_expired,picture,caption,subscribed,description,created_time,link,is_spherical,message';

                $body    = $this->fb->get('/'.$feedRes->id.'/'.$subUrl, $fbToken)->getBody();
                $feedRes = \GuzzleHttp\json_decode($body);

                $feed = $this->getFeedFromJsonObject($feedRes, $input['page_id']);
                $feed = $this->feedRepository->create($feed);

                return Feed::updateWithModel($feed)->response();
            } else {
                throw new APIErrorException('unknown', 'Feed Creation Failed', []);
            }
        } catch (\Exception $exception) {
            throw new APIErrorException('unknown', 'Feed Creation Failed'.$exception->getMessage(), []);
        }
    }

    public function update($id, Request $request)
    {
        $feed    = $this->feedRepository->find($id);
        $input   = $request->only(['facebook_token']);
        $fbToken = $input['facebook_token'];

        $input = $request->only(['message', 'link', 'name', 'caption', 'published', 'full_picture']);
        try {
            $body    = $this->fb->post('/'.$feed->feed_facebook_id, $input, $fbToken)->getBody();
            $feedRes = \GuzzleHttp\json_decode($body);
            if ($feedRes->success) {
                $subUrl     = '?fields=is_hidden,from,full_picture,id,is_published,is_popular,is_expired,picture,caption,subscribed,description,created_time,link,is_spherical,message';
                $body       = $this->fb->get('/'.$feed->feed_facebook_id.'/'.$subUrl, $fbToken)->getBody();
                $feedRes    = \GuzzleHttp\json_decode($body);
                $feedUpdate = $this->getFeedFromJsonObject($feedRes, $feed->page_id);

                $this->feedRepository->update($feed, $feedUpdate);

                return Status::ok('Update feed success')->response();
            }
        } catch (\Exception $exception) {
            throw new APIErrorException('unknown', 'Feed Update Failed'.$exception->getMessage(), []);
        }

        return Status::error('unknown', 'Delete Update success')->response();
    }

    public function destroy($id, Request $request)
    {
        $feed    = $this->feedRepository->find($id);
        $fbToken = $request->get('facebook_token');
        try {
            $body    = $this->fb->delete('/'.$feed->feed_facebook_id, [], $fbToken)->getBody();
            $feedRes = \GuzzleHttp\json_decode($body);
            if ($feedRes->success) {
                $this->feedRepository->delete($feed);

                return Status::ok('Delete feed success')->response();
            }
        } catch (\Exception $exception) {
            throw new APIErrorException('unknown', 'Feed delete Failed'.$exception->getMessage(), []);
        }

        return Status::error('unknown', 'Delete feed success')->response();
    }

    private function getFeedFromJsonObject($feed, $page_id)
    {
        $is_popular   = isset($feed->is_popular) ? $feed->is_popular : null;
        $is_expired   = isset($feed->is_expired) ? $feed->is_expired : null;
        $is_spherical = isset($feed->is_spherical) ? $feed->is_spherical : null;
        $is_hidden    = isset($feed->is_hidden) ? $feed->is_hidden : null;
        $is_published = isset($feed->is_published) ? $feed->is_published : null;
        $subscribed   = isset($feed->subscribed) ? $feed->subscribed : null;
        $full_picture = isset($feed->full_picture) ? $feed->full_picture : null;
        $picture      = isset($feed->picture) ? $feed->picture : null;
        $description  = isset($feed->description) ? $feed->description : null;
        $caption      = isset($feed->caption) ? $feed->caption : null;
        $link         = isset($feed->link) ? $feed->link : null;
        $cMessage     = isset($feed->message) ? $feed->message : '';

        $date         =date_create($feed->created_time);
        $created_time = date_format($date, 'Y-m-d H:i:s');

        $feedRes = ['page_id'=> $page_id, 'feed_facebook_id'=>$feed->id, 'message'=>$cMessage,
            'description'    => $description, 'picture'=>$picture, 'full_picture'=>$full_picture,
            'caption'        => $caption, 'created_time'=> $created_time,
            'link'           => $link, 'is_hidden'=>$is_hidden, 'is_published'=>$is_published, 'is_popular'=>$is_popular,
            'is_expired'     => $is_expired, 'is_spherical'=>$is_spherical, 'subscribed'=>$subscribed, ];

        return $feedRes;
    }
}
