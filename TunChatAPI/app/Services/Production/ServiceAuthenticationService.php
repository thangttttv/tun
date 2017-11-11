<?php
namespace App\Services\Production;

use App\Repositories\AccountRepositoryInterface;
use App\Repositories\Eloquent\AccountRepository;
use App\Repositories\FileRepositoryInterface;
use App\Repositories\ServiceAuthenticationRepositoryInterface;
use App\Services\ServiceAuthenticationServiceInterface;
use Facebook\Facebook;
use LaravelRocket\Foundation\Models\AuthenticatableBase;
use LaravelRocket\Foundation\Repositories\AuthenticatableRepositoryInterface;
use LaravelRocket\Foundation\Services\Production\BaseService;

class ServiceAuthenticationService extends BaseService implements ServiceAuthenticationServiceInterface
{
    /** @var \App\Repositories\ServiceAuthenticationRepositoryInterface */
    protected $serviceAuthenticationRepository;

    /** @var \LaravelRocket\Foundation\Repositories\AuthenticatableRepositoryInterface; */
    protected $authenticatableRepository;

    /** @var FileRepositoryInterface $fileRepository */
    protected $fileRepository;

    /** @var \App\Repositories\AccountRepositoryInterface */
    protected $accountRepository;

    public function __construct(
        AuthenticatableRepositoryInterface $authenticatableRepository,
        ServiceAuthenticationRepositoryInterface $serviceAuthenticationRepository,
        FileRepositoryInterface $fileRepository,
        AccountRepositoryInterface $accountRepository
    ) {
        $this->authenticatableRepository          = $authenticatableRepository;
        $this->serviceAuthenticationRepository    = $serviceAuthenticationRepository;
        $this->fileRepository                     = $fileRepository;
	    $this->accountRepository                  = $accountRepository;
    }

    /**
     * @param string $service
     * @param array  $input
     *
     * @return AuthenticatableBase
     */
    public function getAuthModel($service, $input)
    {
        $columnName = $this->serviceAuthenticationRepository->getAuthModelColumn();

        $authInfo = $this->serviceAuthenticationRepository->findByServiceAndId($service,
            array_get($input, 'service_id'));
        if (!empty($authInfo)) {
            return $this->authenticatableRepository->find($authInfo->$columnName);
        }

        $authUser = $this->authenticatableRepository->findByEmail(array_get($input, 'email'));
        if (!empty($authUser)) {
            $authInfo = $this->serviceAuthenticationRepository->findByServiceAndAuthModelId($service, $authUser->id);
            if (!empty($authInfo)) {
                return $authUser;
            }
        } else {
            if (array_key_exists('avatar', $input)) {
                $image = $this->fileRepository->create([
                    'url'        => $input['avatar'],
                    'is_enabled' => true,
                ]);
                $input['avatar'] = $image->id;
            }
	        $this->accountRepository = new AccountRepository();
            $account = $this->accountRepository->create($input);
            if (!empty($account)) {
                $input['account_id'] = $account->id;
            }
            $authUser = $this->authenticatableRepository->create($input);
        }

        $input[$columnName] = $authUser->id;
        $this->serviceAuthenticationRepository->create($input);

        return $authUser;
    }

    public function facebookSignIn($fbToken)
    {
        $fb = new Facebook([
            'app_id'     => config('services.facebook.client_id'),
            'app_secret' => config('services.facebook.client_secret'),
        ]);
        $serviceUser   = $fb->get('/me?fields=id,email,first_name,last_name,picture', $fbToken)->getGraphUser();
        $serviceUserId = $serviceUser->getId();
        $name          = $serviceUser->getFirstName().''.$serviceUser->getLastName();
        $email         = $serviceUser->getEmail();

        if (empty($email)) {
            return null;
        }

        $array = [
            'service'         => 'facebook',
            'service_id'      => $serviceUserId,
	        'facebook_id'     => $serviceUserId,
            'full_name'       => $name,
            'name'            => $name,
            'email'           => $email,
        ];

        $authUser = $this->getAuthModel('facebook', $array);

        return $authUser;
    }
}
