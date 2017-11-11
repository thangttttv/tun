<?php

namespace App\Repositories\Eloquent;

use LaravelRocket\Foundation\Repositories\Eloquent\SingleKeyModelRepository;
use App\Repositories\SequenceRepositoryInterface;
use App\Models\Sequence;

class SequenceRepository extends SingleKeyModelRepository implements SequenceRepositoryInterface
{

    public function getBlankModel()
    {
        return new Sequence();
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
