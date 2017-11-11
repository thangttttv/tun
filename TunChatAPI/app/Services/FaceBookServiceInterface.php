<?php
namespace App\Services;

use LaravelRocket\Foundation\Services\BaseServiceInterface;

interface FaceBookServiceInterface extends BaseServiceInterface
{
	public function getAllPageByUser($fbToken);
}