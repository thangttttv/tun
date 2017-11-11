<?php

namespace App\Repositories\Eloquent;

use LaravelRocket\Foundation\Repositories\Eloquent\SingleKeyModelRepository;
use App\Repositories\FeedRepositoryInterface;
use App\Models\Feed;

class FeedRepository extends SingleKeyModelRepository implements FeedRepositoryInterface
{

    public function getBlankModel()
    {
        return new Feed();
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
