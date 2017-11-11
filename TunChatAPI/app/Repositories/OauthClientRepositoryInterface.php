<?php
namespace App\Repositories;

use LaravelRocket\Foundation\Repositories\SingleKeyModelRepositoryInterface;

/**
 * @method \App\Models\OauthClient[] getEmptyList()
 * @method \App\Models\OauthClient[]|\Traversable|array all($order = null, $direction = null)
 * @method \App\Models\OauthClient[]|\Traversable|array get($order, $direction, $offset, $limit)
 * @method \App\Models\OauthClient create($value)
 * @method \App\Models\OauthClient find($id)
 * @method \App\Models\OauthClient[]|\Traversable|array allByIds($ids, $order = null, $direction = null, $reorder = false)
 * @method \App\Models\OauthClient[]|\Traversable|array getByIds($ids, $order = null, $direction = null, $offset = null, $limit = null);
 * @method \App\Models\OauthClient update($model, $input)
 * @method \App\Models\OauthClient save($model);
 */
interface OauthClientRepositoryInterface extends SingleKeyModelRepositoryInterface
{
    /**
     * @return \App\Models\OauthClient
     */
    public function getBlankModel();
}
