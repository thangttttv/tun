<?php

namespace App\Repositories\Eloquent;

use LaravelRocket\Foundation\Repositories\Eloquent\SingleKeyModelRepository;
use App\Repositories\PageRepositoryInterface;
use App\Models\Page;

class PageRepository extends SingleKeyModelRepository implements PageRepositoryInterface
{

    public function getBlankModel()
    {
        return new Page();
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
