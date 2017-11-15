<?php

namespace App\Repositories\Eloquent;

use LaravelRocket\Foundation\Repositories\Eloquent\SingleKeyModelRepository;
use App\Repositories\KeywordRepositoryInterface;
use App\Models\Keyword;

class KeywordRepository extends SingleKeyModelRepository implements KeywordRepositoryInterface
{

    public function getBlankModel()
    {
        return new Keyword();
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
