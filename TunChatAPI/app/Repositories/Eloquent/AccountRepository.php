<?php

namespace App\Repositories\Eloquent;

use LaravelRocket\Foundation\Repositories\Eloquent\SingleKeyModelRepository;
use App\Repositories\AccountRepositoryInterface;
use App\Models\Account;

class AccountRepository extends SingleKeyModelRepository implements AccountRepositoryInterface
{

    public function getBlankModel()
    {
        return new Account();
    }

    public function rules()
    {
        return [
        ];
    }

    public function messages()
    {
        return [
        ];
    }

}
