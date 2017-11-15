<?php

namespace App\Repositories\Eloquent;

use LaravelRocket\Foundation\Repositories\Eloquent\SingleKeyModelRepository;
use App\Repositories\KeywordActionRepositoryInterface;
use App\Models\KeywordAction;

class KeywordActionRepository extends SingleKeyModelRepository implements KeywordActionRepositoryInterface
{

    public function getBlankModel()
    {
        return new KeywordAction();
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
