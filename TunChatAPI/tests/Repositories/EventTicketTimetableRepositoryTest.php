<?php

namespace Tests\Repositories;

use App\Models\EventTicketTimetable;
use Tests\TestCase;

class EventTicketTimetableRepositoryTest extends TestCase
{
    protected $useDatabase = true;

    public function testGetInstance()
    {
        /** @var  \App\Repositories\EventTicketTimetableRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\EventTicketTimetableRepositoryInterface::class);
        $this->assertNotNull($repository);
    }

    public function testGetList()
    {
        $models = factory(EventTicketTimetable::class, 3)->create();
        $eventTicketTimetableIds = $models->pluck('id')->toArray();

        /** @var  \App\Repositories\EventTicketTimetableRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\EventTicketTimetableRepositoryInterface::class);
        $this->assertNotNull($repository);

        $modelsCheck = $repository->get('id', 'asc', 0, 1);
        $this->assertInstanceOf(EventTicketTimetable::class, $modelsCheck[0]);

        $modelsCheck = $repository->getByIds($eventTicketTimetableIds);
        $this->assertEquals(3, count($modelsCheck));
    }

    public function testFind()
    {
        $models = factory(EventTicketTimetable::class, 3)->create();
        $eventTicketTimetableIds = $models->pluck('id')->toArray();

        /** @var  \App\Repositories\EventTicketTimetableRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\EventTicketTimetableRepositoryInterface::class);
        $this->assertNotNull($repository);

        $eventTicketTimetableCheck = $repository->find($eventTicketTimetableIds[0]);
        $this->assertEquals($eventTicketTimetableIds[0], $eventTicketTimetableCheck->id);
    }

    public function testCreate()
    {
        $eventTicketTimetableData = factory(EventTicketTimetable::class)->make();

        /** @var  \App\Repositories\EventTicketTimetableRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\EventTicketTimetableRepositoryInterface::class);
        $this->assertNotNull($repository);

        $eventTicketTimetableCheck = $repository->create($eventTicketTimetableData->toFillableArray());
        $this->assertNotNull($eventTicketTimetableCheck);
    }

    public function testUpdate()
    {
        $eventTicketTimetableData = factory(EventTicketTimetable::class)->create();

        /** @var  \App\Repositories\EventTicketTimetableRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\EventTicketTimetableRepositoryInterface::class);
        $this->assertNotNull($repository);

        $eventTicketTimetableCheck = $repository->update($eventTicketTimetableData, $eventTicketTimetableData->toFillableArray());
        $this->assertNotNull($eventTicketTimetableCheck);
    }

    public function testDelete()
    {
        $eventTicketTimetableData = factory(EventTicketTimetable::class)->create();

        /** @var  \App\Repositories\EventTicketTimetableRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\EventTicketTimetableRepositoryInterface::class);
        $this->assertNotNull($repository);

        $repository->delete($eventTicketTimetableData);

        $eventTicketTimetableCheck = $repository->find($eventTicketTimetableData->id);
        $this->assertNull($eventTicketTimetableCheck);
    }

}
