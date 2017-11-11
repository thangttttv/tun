<?php
namespace App\Services\Production;

use App\Services\FaceBookServiceInterface;
use LaravelRocket\Foundation\Services\Production\BaseService;
use Facebook\Facebook;

class FaceBookService extends BaseService implements FaceBookServiceInterface
{
	/** @var \Facebook\Facebook */
	protected $fb;

	public function __construct() {
		$this->fb     = new Facebook([
			'app_id'     => config('services.facebook.client_id'),
			'app_secret' => config('services.facebook.client_secret'),
		]);
	}

	public function getAllPageByUser($fbToken)
    {
	    $pages   = $this->fb ->get('/me/accounts', $fbToken)->getBody();
	    $data  = \GuzzleHttp\json_decode($pages);
	    dd($data->data[0]->name);
    }
}
