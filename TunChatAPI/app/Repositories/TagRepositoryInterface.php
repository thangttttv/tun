<?php

namespace App\Repositories;

use LaravelRocket\Foundation\Repositories\SingleKeyModelRepositoryInterface;
/**
 *
 * @method \App\Models\Tag[] getEmptyList()
 * @method \App\Models\Tag[]|\Traversable|array all($order = null, $direction = null)
 * @method \App\Models\Tag[]|\Traversable|array get($order, $direction, $offset, $limit)
 * @method \App\Models\Tag create($value)
 * @method \App\Models\Tag find($id)
 * @method \App\Models\Tag[]|\Traversable|array allByIds($ids, $order = null, $direction = null, $reorder = false)
 * @method \App\Models\Tag[]|\Traversable|array getByIds($ids, $order = null, $direction = null, $offset = null, $limit = null);
 * @method \App\Models\Tag update($model, $input)
 * @method \App\Models\Tag save($model);
 */

interface TagRepositoryInterface extends SingleKeyModelRepositoryInterface
{
    /**
     * @return \App\Models\Tag
     */
    public function getBlankModel();
}
