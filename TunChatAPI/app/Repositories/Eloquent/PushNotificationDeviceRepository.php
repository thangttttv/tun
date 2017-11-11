<?php
namespace App\Repositories\Eloquent;

use App\Models\PushNotificationDevice;
use App\Repositories\PushNotificationDeviceRepositoryInterface;
use LaravelRocket\Foundation\Repositories\Eloquent\SingleKeyModelRepository;

class PushNotificationDeviceRepository extends SingleKeyModelRepository implements PushNotificationDeviceRepositoryInterface
{
    public function getBlankModel()
    {
        return new PushNotificationDevice();
    }

    public function rules()
    {
        return [];
    }

    public function messages()
    {
        return [];
    }
}
