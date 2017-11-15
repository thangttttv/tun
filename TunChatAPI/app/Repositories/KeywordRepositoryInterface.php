<?php

namespace App\Repositories;

use LaravelRocket\Foundation\Repositories\SingleKeyModelRepositoryInterface;
/**
 *
 * @method \App\Models\Keyword[] getEmptyList()
 * @method \App\Models\Keyword[]|\Traversable|array all($order = null, $direction = null)
 * @method \App\Models\Keyword[]|\Traversable|array get($order, $direction, $offset, $limit)
 * @method \App\Models\Keyword create($value)
 * @method \App\Models\Keyword find($id)
 * @method \App\Models\Keyword[]|\Traversable|array allByIds($ids, $order = null, $direction = null, $reorder = false)
 * @method \App\Models\Keyword[]|\Traversable|array getByIds($ids, $order = null, $direction = null, $offset = null, $limit = null);
 * @method \App\Models\Keyword update($model, $input)
 * @method \App\Models\Keyword save($model);
 */

interface KeywordRepositoryInterface extends SingleKeyModelRepositoryInterface
{
    /**
     * @return \App\Models\Keyword
     */
    public function getBlankModel();
}
