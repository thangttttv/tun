<?php

namespace App\Repositories\Eloquent;

use LaravelRocket\Foundation\Repositories\Eloquent\SingleKeyModelRepository;
use App\Repositories\MessageItemRepositoryInterface;
use App\Models\MessageItem;

class MessageItemRepository extends SingleKeyModelRepository implements MessageItemRepositoryInterface
{

    public function getBlankModel()
    {
        return new MessageItem();
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
