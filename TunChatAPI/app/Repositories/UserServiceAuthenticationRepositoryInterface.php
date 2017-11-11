<?php
namespace App\Repositories;

use LaravelRocket\Foundation\Repositories\SingleKeyModelRepositoryInterface;

/**
 * @method \App\Models\UserServiceAuthentication[] getEmptyList()
 * @method \App\Models\UserServiceAuthentication[]|\Traversable|array all($order = null, $direction = null)
 * @method \App\Models\UserServiceAuthentication[]|\Traversable|array get($order, $direction, $offset, $limit)
 * @method \App\Models\UserServiceAuthentication create($value)
 * @method \App\Models\UserServiceAuthentication find($id)
 * @method \App\Models\UserServiceAuthentication[]|\Traversable|array allByIds($ids, $order = null, $direction = null, $reorder = false)
 * @method \App\Models\UserServiceAuthentication[]|\Traversable|array getByIds($ids, $order = null, $direction = null, $offset = null, $limit = null);
 * @method \App\Models\UserServiceAuthentication update($model, $input)
 * @method \App\Models\UserServiceAuthentication save($model);
 */
interface UserServiceAuthenticationRepositoryInterface extends SingleKeyModelRepositoryInterface
{
    /**
     * @return \App\Models\UserServiceAuthentication
     */
    public function getBlankModel();
}
