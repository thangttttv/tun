<?php

namespace App\Repositories;

use LaravelRocket\Foundation\Repositories\SingleKeyModelRepositoryInterface;
/**
 *
 * @method \App\Models\Page[] getEmptyList()
 * @method \App\Models\Page[]|\Traversable|array all($order = null, $direction = null)
 * @method \App\Models\Page[]|\Traversable|array get($order, $direction, $offset, $limit)
 * @method \App\Models\Page create($value)
 * @method \App\Models\Page find($id)
 * @method \App\Models\Page[]|\Traversable|array allByIds($ids, $order = null, $direction = null, $reorder = false)
 * @method \App\Models\Page[]|\Traversable|array getByIds($ids, $order = null, $direction = null, $offset = null, $limit = null);
 * @method \App\Models\Page update($model, $input)
 * @method \App\Models\Page save($model);
 */

interface PageRepositoryInterface extends SingleKeyModelRepositoryInterface
{
    /**
     * @return \App\Models\Page
     */
    public function getBlankModel();
}
