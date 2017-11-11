<?php
namespace App\Services;

use LaravelRocket\Foundation\Models\AuthenticatableBase;
use LaravelRocket\Foundation\Services\BaseServiceInterface;

interface ServiceAuthenticationServiceInterface extends BaseServiceInterface
{
    /**
     * @param string $service
     * @param array  $input
     *
     * @return AuthenticatableBase
     */
    public function getAuthModel($service, $input);

    /**
     * @param $fbToken
     *
     * @return AuthenticatableBase
     */
    public function facebookSignIn($fbToken);
}
