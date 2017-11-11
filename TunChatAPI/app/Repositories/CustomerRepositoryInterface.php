<?php

namespace App\Repositories;

use LaravelRocket\Foundation\Repositories\SingleKeyModelRepositoryInterface;
/**
 *
 * @method \App\Models\Customer[] getEmptyList()
 * @method \App\Models\Customer[]|\Traversable|array all($order = null, $direction = null)
 * @method \App\Models\Customer[]|\Traversable|array get($order, $direction, $offset, $limit)
 * @method \App\Models\Customer create($value)
 * @method \App\Models\Customer find($id)
 * @method \App\Models\Customer[]|\Traversable|array allByIds($ids, $order = null, $direction = null, $reorder = false)
 * @method \App\Models\Customer[]|\Traversable|array getByIds($ids, $order = null, $direction = null, $offset = null, $limit = null);
 * @method \App\Models\Customer update($model, $input)
 * @method \App\Models\Customer save($model);
 */

interface CustomerRepositoryInterface extends SingleKeyModelRepositoryInterface
{
    /**
     * @return \App\Models\Customer
     */
    public function getBlankModel();
}
