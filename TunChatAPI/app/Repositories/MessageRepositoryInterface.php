<?php

namespace App\Repositories;

use LaravelRocket\Foundation\Repositories\SingleKeyModelRepositoryInterface;
/**
 *
 * @method \App\Models\Message[] getEmptyList()
 * @method \App\Models\Message[]|\Traversable|array all($order = null, $direction = null)
 * @method \App\Models\Message[]|\Traversable|array get($order, $direction, $offset, $limit)
 * @method \App\Models\Message create($value)
 * @method \App\Models\Message find($id)
 * @method \App\Models\Message[]|\Traversable|array allByIds($ids, $order = null, $direction = null, $reorder = false)
 * @method \App\Models\Message[]|\Traversable|array getByIds($ids, $order = null, $direction = null, $offset = null, $limit = null);
 * @method \App\Models\Message update($model, $input)
 * @method \App\Models\Message save($model);
 */

interface MessageRepositoryInterface extends SingleKeyModelRepositoryInterface
{
    /**
     * @return \App\Models\Message
     */
    public function getBlankModel();
}
