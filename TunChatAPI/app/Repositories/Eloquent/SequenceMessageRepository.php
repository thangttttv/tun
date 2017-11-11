<?php

namespace App\Repositories\Eloquent;

use LaravelRocket\Foundation\Repositories\Eloquent\SingleKeyModelRepository;
use App\Repositories\SequenceMessageRepositoryInterface;
use App\Models\SequenceMessage;

class SequenceMessageRepository extends SingleKeyModelRepository implements SequenceMessageRepositoryInterface
{

    public function getBlankModel()
    {
        return new SequenceMessage();
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
