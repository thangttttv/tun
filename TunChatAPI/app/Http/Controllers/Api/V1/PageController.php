<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Requests\Api\V1\PageSubcribedRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Facebook\Facebook;
use App\Http\Responses\Api\V1\Status;
use App\Services\APIUserServiceInterface;
use App\Repositories\PageRepositoryInterface;
use App\Repositories\PageUserRepositoryInterface;

class PageController extends Controller
{

	/** @var \App\Repositories\PageRepositoryInterface */
	protected $pageRepository;

	/** @var \App\Repositories\PageUserRepositoryInterface */
	protected $pageUserRepository;

	/** @var APIUserServiceInterface */
	protected $userService;

	public function __construct(
		PageRepositoryInterface $pageRepository,
		PageUserRepositoryInterface $pageUserRepository,
		APIUserServiceInterface $userService
	) {
		$this->pageRepository           = $pageRepository;
		$this->pageUserRepository     = $pageUserRepository;
		$this->userService     = $userService;
	}

    // pages
	public function index(Request $request)
	{
		$fbToken = $request->get("facebook_token");
		$fb = new Facebook([
			'app_id'     => config('services.facebook.client_id'),
			'app_secret' => config('services.facebook.client_secret'),
		]);
		$pages   = $fb->get('/me/accounts', $fbToken)->getBody();
		//return \GuzzleHttp\json_decode($pages)->data;
		//return Status::ok()->response();
		return response()->json(\GuzzleHttp\json_decode($pages)->data, 200);
	}

	//subscribed page
	public function subscribed(PageSubcribedRequest $request)
	{
		/** @var \App\Models\User $user */
		//$user  = $this->userService->getUser();

		$pageId = $request->get("page_facebook_id");
		$accessToken = $request->get("access_token");
		$fb = new Facebook([
			'app_id'     => config('services.facebook.client_id'),
			'app_secret' => config('services.facebook.client_secret'),
		]);

		$subscribed   = $fb->post('/'.$pageId.'/subscribed_apps', [],$accessToken)->getBody();

		$data = \GuzzleHttp\json_decode($subscribed);
		if($data->success){
			// create page
			$page   = $fb->get('/'.$pageId.'?fields=access_token,name,page_token,category,picture{url},id',$accessToken)->getBody();
			$page = \GuzzleHttp\json_decode($page);

			$page = $this->pageRepository->create(["facebook_id"=>$page->id,"access_token"=>$page->access_token
				,"name"=>$page->name,"page_token"=>$page->page_token,"category"=>$page->category,"picture_url"=>$page->picture->data->url]);

			$pageUser = ["page_id"=>$page->id,"user_id"=>1];
			$this->pageUserRepository->create($pageUser);
			return Status::ok("Subscribed page success.")->response();
		}else{
			return Status::error("unknown","Don't subscribed page.")->response();
		}
	}

	//unSubscribed page
	public function unSubscribed(PageSubcribedRequest $request)
	{
		$pageId = $request->get("page_facebook_id");
		$accessToken = $request->get("access_token");
		$fb = new Facebook([
			'app_id'     => config('services.facebook.client_id'),
			'app_secret' => config('services.facebook.client_secret'),
		]);

		$subscribed   = $fb->delete('/'.$pageId.'/subscribed_apps', [], $accessToken)->getBody();

		$data = \GuzzleHttp\json_decode($subscribed);
		if($data->success){
			// remove page
			$page = $this->pageRepository->findByFacebookId($pageId);
			$this->pageRepository->update($page,["subscribed"=>0]);
			return Status::ok("UnSubscribed page success.")->response();
		}else{
			return Status::error("unknown","Don't UnSubscribed page.")->response();
		}
	}
}
