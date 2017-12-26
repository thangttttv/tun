<?php

namespace App\Repositories;

use LaravelRocket\Foundation\Repositories\SingleKeyModelRepositoryInterface;
/**
 *
 * @method \App\Models\MessageItem[] getEmptyList()
 * @method \App\Models\MessageItem[]|\Traversable|array all($order = null, $direction = null)
 * @method \App\Models\MessageItem[]|\Traversable|array get($order, $direction, $offset, $limit)
 * @method \App\Models\MessageItem create($value)
 * @method \App\Models\MessageItem find($id)
 * @method \App\Models\MessageItem[]|\Traversable|array allByIds($ids, $order = null, $direction = null, $reorder = false)
 * @method \App\Models\MessageItem[]|\Traversable|array getByIds($ids, $order = null, $direction = null, $offset = null, $limit = null);
 * @method \App\Models\MessageItem update($model, $input)
 * @method \App\Models\MessageItem save($model);
 */

interface MessageItemRepositoryInterface extends SingleKeyModelRepositoryInterface
{
    /**
     * @return \App\Models\MessageItem
     */
    public function getBlankModel();
}
