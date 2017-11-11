<?php

namespace Tests\Repositories;

use App\Models\PushNotificationDevice;
use Tests\TestCase;

class PushNotificationDeviceRepositoryTest extends TestCase
{
    protected $useDatabase = true;

    public function testGetInstance()
    {
        /** @var  \App\Repositories\PushNotificationDeviceRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\PushNotificationDeviceRepositoryInterface::class);
        $this->assertNotNull($repository);
    }

    public function testGetList()
    {
        $models = factory(PushNotificationDevice::class, 3)->create();
        $pushNotificationDeviceIds = $models->pluck('id')->toArray();

        /** @var  \App\Repositories\PushNotificationDeviceRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\PushNotificationDeviceRepositoryInterface::class);
        $this->assertNotNull($repository);

        $modelsCheck = $repository->get('id', 'asc', 0, 1);
        $this->assertInstanceOf(PushNotificationDevice::class, $modelsCheck[0]);

        $modelsCheck = $repository->getByIds($pushNotificationDeviceIds);
        $this->assertEquals(3, count($modelsCheck));
    }

    public function testFind()
    {
        $models = factory(PushNotificationDevice::class, 3)->create();
        $pushNotificationDeviceIds = $models->pluck('id')->toArray();

        /** @var  \App\Repositories\PushNotificationDeviceRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\PushNotificationDeviceRepositoryInterface::class);
        $this->assertNotNull($repository);

        $pushNotificationDeviceCheck = $repository->find($pushNotificationDeviceIds[0]);
        $this->assertEquals($pushNotificationDeviceIds[0], $pushNotificationDeviceCheck->id);
    }

    public function testCreate()
    {
        $pushNotificationDeviceData = factory(PushNotificationDevice::class)->make();

        /** @var  \App\Repositories\PushNotificationDeviceRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\PushNotificationDeviceRepositoryInterface::class);
        $this->assertNotNull($repository);

        $pushNotificationDeviceCheck = $repository->create($pushNotificationDeviceData->toFillableArray());
        $this->assertNotNull($pushNotificationDeviceCheck);
    }

    public function testUpdate()
    {
        $pushNotificationDeviceData = factory(PushNotificationDevice::class)->create();

        /** @var  \App\Repositories\PushNotificationDeviceRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\PushNotificationDeviceRepositoryInterface::class);
        $this->assertNotNull($repository);

        $pushNotificationDeviceCheck = $repository->update($pushNotificationDeviceData, $pushNotificationDeviceData->toFillableArray());
        $this->assertNotNull($pushNotificationDeviceCheck);
    }

    public function testDelete()
    {
        $pushNotificationDeviceData = factory(PushNotificationDevice::class)->create();

        /** @var  \App\Repositories\PushNotificationDeviceRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\PushNotificationDeviceRepositoryInterface::class);
        $this->assertNotNull($repository);

        $repository->delete($pushNotificationDeviceData);

        $pushNotificationDeviceCheck = $repository->find($pushNotificationDeviceData->id);
        $this->assertNull($pushNotificationDeviceCheck);
    }

}
