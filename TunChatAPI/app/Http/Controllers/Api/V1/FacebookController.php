<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Facebook\Facebook;

class FacebookController extends Controller
{
	public function getPage(Request $request)
	{
		$fbToken = $request->get("facebook_token");
		$fb = new Facebook([
			'app_id'     => config('services.facebook.client_id'),
			'app_secret' => config('services.facebook.client_secret'),
		]);
		$pages   = $fb->get('/me/accounts', $fbToken)->getBody();
		dd(\GuzzleHttp\json_decode($pages)->data);

		return Status::ok()->response();
	}
}
