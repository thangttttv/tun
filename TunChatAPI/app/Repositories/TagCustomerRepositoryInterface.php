<?php

namespace App\Repositories;

use LaravelRocket\Foundation\Repositories\SingleKeyModelRepositoryInterface;
/**
 *
 * @method \App\Models\TagCustomer[] getEmptyList()
 * @method \App\Models\TagCustomer[]|\Traversable|array all($order = null, $direction = null)
 * @method \App\Models\TagCustomer[]|\Traversable|array get($order, $direction, $offset, $limit)
 * @method \App\Models\TagCustomer create($value)
 * @method \App\Models\TagCustomer find($id)
 * @method \App\Models\TagCustomer[]|\Traversable|array allByIds($ids, $order = null, $direction = null, $reorder = false)
 * @method \App\Models\TagCustomer[]|\Traversable|array getByIds($ids, $order = null, $direction = null, $offset = null, $limit = null);
 * @method \App\Models\TagCustomer update($model, $input)
 * @method \App\Models\TagCustomer save($model);
 */

interface TagCustomerRepositoryInterface extends SingleKeyModelRepositoryInterface
{
    /**
     * @return \App\Models\TagCustomer
     */
    public function getBlankModel();
}
