<?php

namespace App\Repositories;

use LaravelRocket\Foundation\Repositories\SingleKeyModelRepositoryInterface;
/**
 *
 * @method \App\Models\Sequence[] getEmptyList()
 * @method \App\Models\Sequence[]|\Traversable|array all($order = null, $direction = null)
 * @method \App\Models\Sequence[]|\Traversable|array get($order, $direction, $offset, $limit)
 * @method \App\Models\Sequence create($value)
 * @method \App\Models\Sequence find($id)
 * @method \App\Models\Sequence[]|\Traversable|array allByIds($ids, $order = null, $direction = null, $reorder = false)
 * @method \App\Models\Sequence[]|\Traversable|array getByIds($ids, $order = null, $direction = null, $offset = null, $limit = null);
 * @method \App\Models\Sequence update($model, $input)
 * @method \App\Models\Sequence save($model);
 */

interface SequenceRepositoryInterface extends SingleKeyModelRepositoryInterface
{
    /**
     * @return \App\Models\Sequence
     */
    public function getBlankModel();
}
