<?php

namespace App\Repositories\Eloquent;

use LaravelRocket\Foundation\Repositories\Eloquent\SingleKeyModelRepository;
use App\Repositories\PageUserRepositoryInterface;
use App\Models\PageUser;

class PageUserRepository extends SingleKeyModelRepository implements PageUserRepositoryInterface
{

    public function getBlankModel()
    {
        return new PageUser();
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
