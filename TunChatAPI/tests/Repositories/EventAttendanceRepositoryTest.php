<?php

namespace Tests\Repositories;

use App\Models\EventAttendance;
use Tests\TestCase;

class EventAttendanceRepositoryTest extends TestCase
{
    protected $useDatabase = true;

    public function testGetInstance()
    {
        /** @var  \App\Repositories\EventAttendanceRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\EventAttendanceRepositoryInterface::class);
        $this->assertNotNull($repository);
    }

    public function testGetList()
    {
        $models = factory(EventAttendance::class, 3)->create();
        $eventAttendanceIds = $models->pluck('id')->toArray();

        /** @var  \App\Repositories\EventAttendanceRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\EventAttendanceRepositoryInterface::class);
        $this->assertNotNull($repository);

        $modelsCheck = $repository->get('id', 'asc', 0, 1);
        $this->assertInstanceOf(EventAttendance::class, $modelsCheck[0]);

        $modelsCheck = $repository->getByIds($eventAttendanceIds);
        $this->assertEquals(3, count($modelsCheck));
    }

    public function testFind()
    {
        $models = factory(EventAttendance::class, 3)->create();
        $eventAttendanceIds = $models->pluck('id')->toArray();

        /** @var  \App\Repositories\EventAttendanceRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\EventAttendanceRepositoryInterface::class);
        $this->assertNotNull($repository);

        $eventAttendanceCheck = $repository->find($eventAttendanceIds[0]);
        $this->assertEquals($eventAttendanceIds[0], $eventAttendanceCheck->id);
    }

    public function testCreate()
    {
        $eventAttendanceData = factory(EventAttendance::class)->make();

        /** @var  \App\Repositories\EventAttendanceRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\EventAttendanceRepositoryInterface::class);
        $this->assertNotNull($repository);

        $eventAttendanceCheck = $repository->create($eventAttendanceData->toFillableArray());
        $this->assertNotNull($eventAttendanceCheck);
    }

    public function testUpdate()
    {
        $eventAttendanceData = factory(EventAttendance::class)->create();

        /** @var  \App\Repositories\EventAttendanceRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\EventAttendanceRepositoryInterface::class);
        $this->assertNotNull($repository);

        $eventAttendanceCheck = $repository->update($eventAttendanceData, $eventAttendanceData->toFillableArray());
        $this->assertNotNull($eventAttendanceCheck);
    }

    public function testDelete()
    {
        $eventAttendanceData = factory(EventAttendance::class)->create();

        /** @var  \App\Repositories\EventAttendanceRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\EventAttendanceRepositoryInterface::class);
        $this->assertNotNull($repository);

        $repository->delete($eventAttendanceData);

        $eventAttendanceCheck = $repository->find($eventAttendanceData->id);
        $this->assertNull($eventAttendanceCheck);
    }

}
