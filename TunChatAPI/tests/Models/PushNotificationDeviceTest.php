<?php

namespace Tests\Models;

use App\Models\PushNotificationDevice;
use Tests\TestCase;

class PushNotificationDeviceTest extends TestCase
{

    protected $useDatabase = true;

    public function testGetInstance()
    {
        /** @var  \App\Models\PushNotificationDevice $pushNotificationDevice */
        $pushNotificationDevice = new PushNotificationDevice();
        $this->assertNotNull($pushNotificationDevice);
    }

    public function testStoreNew()
    {
        /** @var  \App\Models\PushNotificationDevice $pushNotificationDevice */
        $pushNotificationDeviceModel = new PushNotificationDevice();

        $pushNotificationDeviceData = factory(PushNotificationDevice::class)->make();
        foreach( $pushNotificationDeviceData->toFillableArray() as $key => $value ) {
            $pushNotificationDeviceModel->$key = $value;
        }
        $pushNotificationDeviceModel->save();

        $this->assertNotNull(PushNotificationDevice::find($pushNotificationDeviceModel->id));
    }

}
