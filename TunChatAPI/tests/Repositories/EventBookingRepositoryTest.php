<?php

namespace Tests\Repositories;

use App\Models\EventBooking;
use Tests\TestCase;

class EventBookingRepositoryTest extends TestCase
{
    protected $useDatabase = true;

    public function testGetInstance()
    {
        /** @var  \App\Repositories\EventBookingRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\EventBookingRepositoryInterface::class);
        $this->assertNotNull($repository);
    }

    public function testGetList()
    {
        $models = factory(EventBooking::class, 3)->create();
        $eventBookingIds = $models->pluck('id')->toArray();

        /** @var  \App\Repositories\EventBookingRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\EventBookingRepositoryInterface::class);
        $this->assertNotNull($repository);

        $modelsCheck = $repository->get('id', 'asc', 0, 1);
        $this->assertInstanceOf(EventBooking::class, $modelsCheck[0]);

        $modelsCheck = $repository->getByIds($eventBookingIds);
        $this->assertEquals(3, count($modelsCheck));
    }

    public function testFind()
    {
        $models = factory(EventBooking::class, 3)->create();
        $eventBookingIds = $models->pluck('id')->toArray();

        /** @var  \App\Repositories\EventBookingRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\EventBookingRepositoryInterface::class);
        $this->assertNotNull($repository);

        $eventBookingCheck = $repository->find($eventBookingIds[0]);
        $this->assertEquals($eventBookingIds[0], $eventBookingCheck->id);
    }

    public function testCreate()
    {
        $eventBookingData = factory(EventBooking::class)->make();

        /** @var  \App\Repositories\EventBookingRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\EventBookingRepositoryInterface::class);
        $this->assertNotNull($repository);

        $eventBookingCheck = $repository->create($eventBookingData->toFillableArray());
        $this->assertNotNull($eventBookingCheck);
    }

    public function testUpdate()
    {
        $eventBookingData = factory(EventBooking::class)->create();

        /** @var  \App\Repositories\EventBookingRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\EventBookingRepositoryInterface::class);
        $this->assertNotNull($repository);

        $eventBookingCheck = $repository->update($eventBookingData, $eventBookingData->toFillableArray());
        $this->assertNotNull($eventBookingCheck);
    }

    public function testDelete()
    {
        $eventBookingData = factory(EventBooking::class)->create();

        /** @var  \App\Repositories\EventBookingRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\EventBookingRepositoryInterface::class);
        $this->assertNotNull($repository);

        $repository->delete($eventBookingData);

        $eventBookingCheck = $repository->find($eventBookingData->id);
        $this->assertNull($eventBookingCheck);
    }

}
