<?php

namespace App\Repositories;

use LaravelRocket\Foundation\Repositories\SingleKeyModelRepositoryInterface;
/**
 *
 * @method \App\Models\Feed[] getEmptyList()
 * @method \App\Models\Feed[]|\Traversable|array all($order = null, $direction = null)
 * @method \App\Models\Feed[]|\Traversable|array get($order, $direction, $offset, $limit)
 * @method \App\Models\Feed create($value)
 * @method \App\Models\Feed find($id)
 * @method \App\Models\Feed[]|\Traversable|array allByIds($ids, $order = null, $direction = null, $reorder = false)
 * @method \App\Models\Feed[]|\Traversable|array getByIds($ids, $order = null, $direction = null, $offset = null, $limit = null);
 * @method \App\Models\Feed update($model, $input)
 * @method \App\Models\Feed save($model);
 */

interface FeedRepositoryInterface extends SingleKeyModelRepositoryInterface
{
    /**
     * @return \App\Models\Feed
     */
    public function getBlankModel();
}
