<?php
namespace App\Repositories;

use LaravelRocket\Foundation\Repositories\SingleKeyModelRepositoryInterface;

/**
 * @method \App\Models\PushNotificationDevice[] getEmptyList()
 * @method \App\Models\PushNotificationDevice[]|\Traversable|array all($order = null, $direction = null)
 * @method \App\Models\PushNotificationDevice[]|\Traversable|array get($order, $direction, $offset, $limit)
 * @method \App\Models\PushNotificationDevice create($value)
 * @method \App\Models\PushNotificationDevice find($id)
 * @method \App\Models\PushNotificationDevice[]|\Traversable|array allByIds($ids, $order = null, $direction = null, $reorder = false)
 * @method \App\Models\PushNotificationDevice[]|\Traversable|array getByIds($ids, $order = null, $direction = null, $offset = null, $limit = null);
 * @method \App\Models\PushNotificationDevice update($model, $input)
 * @method \App\Models\PushNotificationDevice save($model);
 */
interface PushNotificationDeviceRepositoryInterface extends SingleKeyModelRepositoryInterface
{
    /**
     * @return \App\Models\PushNotificationDevice
     */
    public function getBlankModel();
}
