<?php

namespace App\Repositories\Eloquent;

use LaravelRocket\Foundation\Repositories\Eloquent\SingleKeyModelRepository;
use App\Repositories\CustomerCustomFieldRepositoryInterface;
use App\Models\CustomerCustomField;

class CustomerCustomFieldRepository extends SingleKeyModelRepository implements CustomerCustomFieldRepositoryInterface
{

    public function getBlankModel()
    {
        return new CustomerCustomField();
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
