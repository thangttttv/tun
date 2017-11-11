<?php

namespace App\Repositories\Eloquent;

use LaravelRocket\Foundation\Repositories\Eloquent\SingleKeyModelRepository;
use App\Repositories\TagCustomerRepositoryInterface;
use App\Models\TagCustomer;

class TagCustomerRepository extends SingleKeyModelRepository implements TagCustomerRepositoryInterface
{

    public function getBlankModel()
    {
        return new TagCustomer();
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
