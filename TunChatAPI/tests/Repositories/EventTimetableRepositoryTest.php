<?php

namespace Tests\Repositories;

use App\Models\EventTimetable;
use Tests\TestCase;

class EventTimetableRepositoryTest extends TestCase
{
    protected $useDatabase = true;

    public function testGetInstance()
    {
        /** @var  \App\Repositories\EventTimetableRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\EventTimetableRepositoryInterface::class);
        $this->assertNotNull($repository);
    }

    public function testGetList()
    {
        $models = factory(EventTimetable::class, 3)->create();
        $eventTimetableIds = $models->pluck('id')->toArray();

        /** @var  \App\Repositories\EventTimetableRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\EventTimetableRepositoryInterface::class);
        $this->assertNotNull($repository);

        $modelsCheck = $repository->get('id', 'asc', 0, 1);
        $this->assertInstanceOf(EventTimetable::class, $modelsCheck[0]);

        $modelsCheck = $repository->getByIds($eventTimetableIds);
        $this->assertEquals(3, count($modelsCheck));
    }

    public function testFind()
    {
        $models = factory(EventTimetable::class, 3)->create();
        $eventTimetableIds = $models->pluck('id')->toArray();

        /** @var  \App\Repositories\EventTimetableRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\EventTimetableRepositoryInterface::class);
        $this->assertNotNull($repository);

        $eventTimetableCheck = $repository->find($eventTimetableIds[0]);
        $this->assertEquals($eventTimetableIds[0], $eventTimetableCheck->id);
    }

    public function testCreate()
    {
        $eventTimetableData = factory(EventTimetable::class)->make();

        /** @var  \App\Repositories\EventTimetableRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\EventTimetableRepositoryInterface::class);
        $this->assertNotNull($repository);

        $eventTimetableCheck = $repository->create($eventTimetableData->toFillableArray());
        $this->assertNotNull($eventTimetableCheck);
    }

    public function testUpdate()
    {
        $eventTimetableData = factory(EventTimetable::class)->create();

        /** @var  \App\Repositories\EventTimetableRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\EventTimetableRepositoryInterface::class);
        $this->assertNotNull($repository);

        $eventTimetableCheck = $repository->update($eventTimetableData, $eventTimetableData->toFillableArray());
        $this->assertNotNull($eventTimetableCheck);
    }

    public function testDelete()
    {
        $eventTimetableData = factory(EventTimetable::class)->create();

        /** @var  \App\Repositories\EventTimetableRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\EventTimetableRepositoryInterface::class);
        $this->assertNotNull($repository);

        $repository->delete($eventTimetableData);

        $eventTimetableCheck = $repository->find($eventTimetableData->id);
        $this->assertNull($eventTimetableCheck);
    }

}
