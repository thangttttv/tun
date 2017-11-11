<?php
namespace App\Services\Production;

use App\Exceptions\APIErrorException;
use App\Repositories\OauthClientRepositoryInterface;
use App\Repositories\UserPasswordResetRepositoryInterface;
use App\Repositories\UserRepositoryInterface;
use App\Services\UserServiceInterface;
use LaravelRocket\Foundation\Services\Production\AuthenticatableService;

class UserService extends AuthenticatableService implements UserServiceInterface
{
    /** @var string $resetEmailTitle */
    protected $resetEmailTitle = 'Reset Password';

    /** @var string $resetEmailTemplate */
    protected $resetEmailTemplate = 'emails.user.reset_password';

    /** @var \App\Repositories\OauthClientRepositoryInterface */
    protected $oauthClientRepository;

    public function __construct(
        UserRepositoryInterface $userRepository,
        UserPasswordResetRepositoryInterface $userPasswordResetRepository,
        OauthClientRepositoryInterface $oauthClientRepository
    ) {
        $this->authenticatableRepository    = $userRepository;
        $this->passwordResettableRepository = $userPasswordResetRepository;
        $this->oauthClientRepository        = $oauthClientRepository;
    }

    public function getGuardName()
    {
        return 'web';
    }

    public function checkClient($request, $grantType)
    {
        $passwordClient = false;
        if ($grantType == 'password') {
            $passwordClient = true;
        }
        $oauthClient = $this->oauthClientRepository->findByIdAndSecretAndPasswordClient($request->get('client_id'),
            $request->get('client_secret'), $passwordClient);
        if (empty($oauthClient)) {
            throw new APIErrorException('authFailed', 'Signin falied',
                ['invalidParams' => config('api.validateErrors.clientValidate')]);
        }
    }
}
