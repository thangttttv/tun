<?php
namespace App\Repositories\Eloquent;

use App\Models\UserServiceAuthentication;
use App\Repositories\UserServiceAuthenticationRepositoryInterface;
use LaravelRocket\Foundation\Repositories\Eloquent\SingleKeyModelRepository;

class UserServiceAuthenticationRepository extends SingleKeyModelRepository implements UserServiceAuthenticationRepositoryInterface
{
    public function getBlankModel()
    {
        return new UserServiceAuthentication();
    }

    public function rules()
    {
        return [];
    }

    public function messages()
    {
        return [];
    }

    public $authModelColumn = 'user_id';

    public function getAuthModelColumn()
    {
        return $this->authModelColumn;
    }

    public function findByServiceAndAuthModelId($service, $authModelId)
    {
        $class = $this->getModelClassName();

        return $class::whereService($service)->where("$this->authModelColumn", $authModelId)->first();
    }
}
