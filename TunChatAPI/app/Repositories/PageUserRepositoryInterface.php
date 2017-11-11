<?php

namespace App\Repositories;

use LaravelRocket\Foundation\Repositories\SingleKeyModelRepositoryInterface;
/**
 *
 * @method \App\Models\PageUser[] getEmptyList()
 * @method \App\Models\PageUser[]|\Traversable|array all($order = null, $direction = null)
 * @method \App\Models\PageUser[]|\Traversable|array get($order, $direction, $offset, $limit)
 * @method \App\Models\PageUser create($value)
 * @method \App\Models\PageUser find($id)
 * @method \App\Models\PageUser[]|\Traversable|array allByIds($ids, $order = null, $direction = null, $reorder = false)
 * @method \App\Models\PageUser[]|\Traversable|array getByIds($ids, $order = null, $direction = null, $offset = null, $limit = null);
 * @method \App\Models\PageUser update($model, $input)
 * @method \App\Models\PageUser save($model);
 */

interface PageUserRepositoryInterface extends SingleKeyModelRepositoryInterface
{
    /**
     * @return \App\Models\PageUser
     */
    public function getBlankModel();
}
