<?php

namespace App\Repositories;

use LaravelRocket\Foundation\Repositories\SingleKeyModelRepositoryInterface;
/**
 *
 * @method \App\Models\Account[] getEmptyList()
 * @method \App\Models\Account[]|\Traversable|array all($order = null, $direction = null)
 * @method \App\Models\Account[]|\Traversable|array get($order, $direction, $offset, $limit)
 * @method \App\Models\Account create($value)
 * @method \App\Models\Account find($id)
 * @method \App\Models\Account[]|\Traversable|array allByIds($ids, $order = null, $direction = null, $reorder = false)
 * @method \App\Models\Account[]|\Traversable|array getByIds($ids, $order = null, $direction = null, $offset = null, $limit = null);
 * @method \App\Models\Account update($model, $input)
 * @method \App\Models\Account save($model);
 */

interface AccountRepositoryInterface extends SingleKeyModelRepositoryInterface
{
    /**
     * @return \App\Models\Account
     */
    public function getBlankModel();
}
