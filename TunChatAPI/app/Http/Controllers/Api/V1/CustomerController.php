<?php
namespace App\Http\Controllers\Api\V1;

use App\Exceptions\APIErrorException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\CustomerRequest;
use App\Http\Requests\Api\V1\PaginationCustomerRequest;
use App\Http\Responses\Api\V1\Customer;
use App\Http\Responses\Api\V1\Customers;
use App\Http\Responses\Api\V1\Status;
use App\Repositories\CustomerRepositoryInterface;
use App\Repositories\PageRepositoryInterface;
use App\Services\APIUserServiceInterface;
use Facebook\Facebook;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /** @var \App\Repositories\CustomerRepositoryInterface */
    protected $customerRepository;

    /** @var APIUserServiceInterface */
    protected $userService;

    /** @var PageRepositoryInterface */
    protected $pageRepository;

    public function __construct(
        CustomerRepositoryInterface $customerRepository,
        APIUserServiceInterface $userService,
        PageRepositoryInterface $pageRepository
    ) {
        $this->customerRepository           = $customerRepository;
        $this->userService                  = $userService;
        $this->pageRepository               = $pageRepository;
    }

    // get customer by conversation
    public function conversations(Request $request)
    {
        $fbToken          = $request->get('facebook_token');
        $facebook_page_id = $request->get('facebook_page_id');
        $fb               = new Facebook([
            'app_id'     => config('services.facebook.client_id'),
            'app_secret' => config('services.facebook.client_secret'),
        ]);
        $subUrl = 'conversations?fields=name,senders,id,message_count,snippet,is_subscribed,can_reply,
		participants,messages{message,tags,shares,id},
		thread_key,link,wallpaper,unread_count,updated_time,former_participants&limit=100';
        $sdata   = $fb->get('/'.$facebook_page_id.'/'.$subUrl, $fbToken)->getBody();

        $conversation = \GuzzleHttp\json_decode($sdata);
        $messages     =  $conversation->data;
        $page         = $this->pageRepository->findByFacebookId($facebook_page_id);
        if ($page != null) {
            foreach ($messages as $message) {
                try {
                    $dataCus = ['page_id'=> $page->id, 'name'=>$message->senders->data[0]->name, 'email'=>$message->senders->data[0]->email,
                        'subscribed'     => $message->is_subscribed, 'can_reply'=>$message->can_reply, 'facebook_id'=>$message->senders->data[0]->id, ];
                    $this->customerRepository->create($dataCus);
                } catch (\Exception $exception) {
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

        $customers  = $this->customerRepository->getByFilter($filters, $request->order(), $request->direction(), $offset, $limit + 1);
        $hasNext    = false;

        if (count($customers) > $limit) {
            $hasNext    = true;
            $customers  = $customers->slice(0, $limit);
        }

        return Customers::updateListWithModel($customers, $offset, $limit, $hasNext)->response();
    }

    /**
     * @param $id
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $customer = $this->customerRepository->find($id);
        if (empty($customer)) {
            throw new APIErrorException('notFound', 'Customer Not Found', []);
        }

        return Customer::updateWithModel($customer)->response();
    }

    public function store(CustomerRequest $request)
    {
        /** @var \App\Models\User $user */
        $user  = $this->userService->getUser();
        $input = $request->only(['page_id', 'facebook_id', 'name', 'email', 'mobile', 'gender', 'opted_in_through', 'time_subscribed', 'avatar_url', 'subscribed', 'can_reply', 'country', 'address']);

        if (!empty($request->get('time_subscribed'))) {
            $input['time_subscribed'] = date('Y-m-d H:i:s', $request->get('time_subscribed'));
        }

        // create customer
        try {
            $customer = $this->customerRepository->create($input);

            return Customer::updateWithModel($customer)->response();
        } catch (\Exception $exception) {
        }

        if (empty($customer)) {
            throw new APIErrorException('unknown', 'Customer Creation Failed', []);
        }
    }
}
