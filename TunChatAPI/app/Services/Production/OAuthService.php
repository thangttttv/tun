<?php
namespace App\Services\Production;

use App\Repositories\UserPasswordResetRepositoryInterface;
use App\Repositories\UserRepositoryInterface;
use App\Services\OAuthServiceInterface;
use LaravelRocket\Foundation\Services\Production\BaseService;

class OAuthService extends BaseService implements OAuthServiceInterface
{
    /** @var \App\Repositories\UserRepositoryInterface $userRepository */
    protected $userRepository;

    /** @var \App\Repositories\UserPasswordResetRepositoryInterface $userPasswordResetRepository */
    protected $userPasswordResetRepository;

    public function __construct(
        UserRepositoryInterface $userRepository,
        UserPasswordResetRepositoryInterface $userPasswordResetRepository
    ) {
        $this->userRepository              = $userRepository;
        $this->userPasswordResetRepository = $userPasswordResetRepository;
    }

    public function generateToken($userId)
    {
        /** @var \App\Models\User $user */
        $user = $this->userRepository->find($userId);
        if (empty($user)) {
            return null;
        }

        return $token = $user->createToken('facebook_signin')->accessToken;
    }

    public function generateTokenResetPassword($userId)
    {
        $user = $this->userRepository->find($userId);
        if (empty($user)) {
            return null;
        }
        $token = $this->userPasswordResetRepository->create($user);

        return $token;
    }
}
