<?php

namespace App\Repositories;

use LaravelRocket\Foundation\Repositories\SingleKeyModelRepositoryInterface;
/**
 *
 * @method \App\Models\SequenceMessage[] getEmptyList()
 * @method \App\Models\SequenceMessage[]|\Traversable|array all($order = null, $direction = null)
 * @method \App\Models\SequenceMessage[]|\Traversable|array get($order, $direction, $offset, $limit)
 * @method \App\Models\SequenceMessage create($value)
 * @method \App\Models\SequenceMessage find($id)
 * @method \App\Models\SequenceMessage[]|\Traversable|array allByIds($ids, $order = null, $direction = null, $reorder = false)
 * @method \App\Models\SequenceMessage[]|\Traversable|array getByIds($ids, $order = null, $direction = null, $offset = null, $limit = null);
 * @method \App\Models\SequenceMessage update($model, $input)
 * @method \App\Models\SequenceMessage save($model);
 */

interface SequenceMessageRepositoryInterface extends SingleKeyModelRepositoryInterface
{
    /**
     * @return \App\Models\SequenceMessage
     */
    public function getBlankModel();
}
