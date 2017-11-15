<?php

namespace App\Repositories;

use LaravelRocket\Foundation\Repositories\SingleKeyModelRepositoryInterface;
/**
 *
 * @method \App\Models\KeywordAction[] getEmptyList()
 * @method \App\Models\KeywordAction[]|\Traversable|array all($order = null, $direction = null)
 * @method \App\Models\KeywordAction[]|\Traversable|array get($order, $direction, $offset, $limit)
 * @method \App\Models\KeywordAction create($value)
 * @method \App\Models\KeywordAction find($id)
 * @method \App\Models\KeywordAction[]|\Traversable|array allByIds($ids, $order = null, $direction = null, $reorder = false)
 * @method \App\Models\KeywordAction[]|\Traversable|array getByIds($ids, $order = null, $direction = null, $offset = null, $limit = null);
 * @method \App\Models\KeywordAction update($model, $input)
 * @method \App\Models\KeywordAction save($model);
 */

interface KeywordActionRepositoryInterface extends SingleKeyModelRepositoryInterface
{
    /**
     * @return \App\Models\KeywordAction
     */
    public function getBlankModel();
}
