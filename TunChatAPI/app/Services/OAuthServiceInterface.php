<?php
namespace App\Services;

use LaravelRocket\Foundation\Services\BaseServiceInterface;

interface OAuthServiceInterface extends BaseServiceInterface
{
    /**
     * @param int $userId
     *
     * @return string
     */
    public function generateToken($userId);

    /**
     * @param $userId
     *
     * @return $string
     */
    public function generateTokenResetPassword($userId);
}
