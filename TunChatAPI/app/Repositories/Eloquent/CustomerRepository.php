<?php

namespace App\Repositories\Eloquent;

use LaravelRocket\Foundation\Repositories\Eloquent\SingleKeyModelRepository;
use App\Repositories\CustomerRepositoryInterface;
use App\Models\Customer;

class CustomerRepository extends SingleKeyModelRepository implements CustomerRepositoryInterface
{

    public function getBlankModel()
    {
        return new Customer();
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
