<?php
namespace App\Services;

use LaravelRocket\Foundation\Http\Requests\Request;
use LaravelRocket\Foundation\Services\AuthenticatableServiceInterface;

interface UserServiceInterface extends AuthenticatableServiceInterface
{
    /**
     * @param Request $request
     * @param string  $grantType
     *
     * @return null
     */
    public function checkClient($request, $grantType);

    /**
     * @return \App\Models\User
     */
    public function getUser();
}
