<?php

namespace App\Repositories;

use LaravelRocket\Foundation\Repositories\SingleKeyModelRepositoryInterface;
/**
 *
 * @method \App\Models\CustomerCustomField[] getEmptyList()
 * @method \App\Models\CustomerCustomField[]|\Traversable|array all($order = null, $direction = null)
 * @method \App\Models\CustomerCustomField[]|\Traversable|array get($order, $direction, $offset, $limit)
 * @method \App\Models\CustomerCustomField create($value)
 * @method \App\Models\CustomerCustomField find($id)
 * @method \App\Models\CustomerCustomField[]|\Traversable|array allByIds($ids, $order = null, $direction = null, $reorder = false)
 * @method \App\Models\CustomerCustomField[]|\Traversable|array getByIds($ids, $order = null, $direction = null, $offset = null, $limit = null);
 * @method \App\Models\CustomerCustomField update($model, $input)
 * @method \App\Models\CustomerCustomField save($model);
 */

interface CustomerCustomFieldRepositoryInterface extends SingleKeyModelRepositoryInterface
{
    /**
     * @return \App\Models\CustomerCustomField
     */
    public function getBlankModel();
}
