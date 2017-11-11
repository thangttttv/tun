<?php

namespace App\Repositories\Eloquent;

use LaravelRocket\Foundation\Repositories\Eloquent\SingleKeyModelRepository;
use App\Repositories\TagRepositoryInterface;
use App\Models\Tag;

class TagRepository extends SingleKeyModelRepository implements TagRepositoryInterface
{

    public function getBlankModel()
    {
        return new Tag();
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
