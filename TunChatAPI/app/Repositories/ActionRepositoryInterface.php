<?php

namespace App\Repositories;

use LaravelRocket\Foundation\Repositories\SingleKeyModelRepositoryInterface;
/**
 *
 * @method \App\Models\Action[] getEmptyList()
 * @method \App\Models\Action[]|\Traversable|array all($order = null, $direction = null)
 * @method \App\Models\Action[]|\Traversable|array get($order, $direction, $offset, $limit)
 * @method \App\Models\Action create($value)
 * @method \App\Models\Action find($id)
 * @method \App\Models\Action[]|\Traversable|array allByIds($ids, $order = null, $direction = null, $reorder = false)
 * @method \App\Models\Action[]|\Traversable|array getByIds($ids, $order = null, $direction = null, $offset = null, $limit = null);
 * @method \App\Models\Action update($model, $input)
 * @method \App\Models\Action save($model);
 */

interface ActionRepositoryInterface extends SingleKeyModelRepositoryInterface
{
    /**
     * @return \App\Models\Action
     */
    public function getBlankModel();
}
