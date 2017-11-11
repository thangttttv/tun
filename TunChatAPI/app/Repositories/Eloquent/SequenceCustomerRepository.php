<?php

namespace App\Repositories\Eloquent;

use LaravelRocket\Foundation\Repositories\Eloquent\SingleKeyModelRepository;
use App\Repositories\SequenceCustomerRepositoryInterface;
use App\Models\SequenceCustomer;

class SequenceCustomerRepository extends SingleKeyModelRepository implements SequenceCustomerRepositoryInterface
{

    public function getBlankModel()
    {
        return new SequenceCustomer();
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
