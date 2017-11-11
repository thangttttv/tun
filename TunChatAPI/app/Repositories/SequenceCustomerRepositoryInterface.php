<?php

namespace App\Repositories;

use LaravelRocket\Foundation\Repositories\SingleKeyModelRepositoryInterface;
/**
 *
 * @method \App\Models\SequenceCustomer[] getEmptyList()
 * @method \App\Models\SequenceCustomer[]|\Traversable|array all($order = null, $direction = null)
 * @method \App\Models\SequenceCustomer[]|\Traversable|array get($order, $direction, $offset, $limit)
 * @method \App\Models\SequenceCustomer create($value)
 * @method \App\Models\SequenceCustomer find($id)
 * @method \App\Models\SequenceCustomer[]|\Traversable|array allByIds($ids, $order = null, $direction = null, $reorder = false)
 * @method \App\Models\SequenceCustomer[]|\Traversable|array getByIds($ids, $order = null, $direction = null, $offset = null, $limit = null);
 * @method \App\Models\SequenceCustomer update($model, $input)
 * @method \App\Models\SequenceCustomer save($model);
 */

interface SequenceCustomerRepositoryInterface extends SingleKeyModelRepositoryInterface
{
    /**
     * @return \App\Models\SequenceCustomer
     */
    public function getBlankModel();
}
