<?php

namespace Tests\Repositories;

use App\Models\EventOrganizer;
use Tests\TestCase;

class EventOrganizerRepositoryTest extends TestCase
{
    protected $useDatabase = true;

    public function testGetInstance()
    {
        /** @var  \App\Repositories\EventOrganizerRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\EventOrganizerRepositoryInterface::class);
        $this->assertNotNull($repository);
    }

    public function testGetList()
    {
        $models = factory(EventOrganizer::class, 3)->create();
        $eventOrganizerIds = $models->pluck('id')->toArray();

        /** @var  \App\Repositories\EventOrganizerRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\EventOrganizerRepositoryInterface::class);
        $this->assertNotNull($repository);

        $modelsCheck = $repository->get('id', 'asc', 0, 1);
        $this->assertInstanceOf(EventOrganizer::class, $modelsCheck[0]);

        $modelsCheck = $repository->getByIds($eventOrganizerIds);
        $this->assertEquals(3, count($modelsCheck));
    }

    public function testFind()
    {
        $models = factory(EventOrganizer::class, 3)->create();
        $eventOrganizerIds = $models->pluck('id')->toArray();

        /** @var  \App\Repositories\EventOrganizerRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\EventOrganizerRepositoryInterface::class);
        $this->assertNotNull($repository);

        $eventOrganizerCheck = $repository->find($eventOrganizerIds[0]);
        $this->assertEquals($eventOrganizerIds[0], $eventOrganizerCheck->id);
    }

    public function testCreate()
    {
        $eventOrganizerData = factory(EventOrganizer::class)->make();

        /** @var  \App\Repositories\EventOrganizerRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\EventOrganizerRepositoryInterface::class);
        $this->assertNotNull($repository);

        $eventOrganizerCheck = $repository->create($eventOrganizerData->toFillableArray());
        $this->assertNotNull($eventOrganizerCheck);
    }

    public function testUpdate()
    {
        $eventOrganizerData = factory(EventOrganizer::class)->create();

        /** @var  \App\Repositories\EventOrganizerRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\EventOrganizerRepositoryInterface::class);
        $this->assertNotNull($repository);

        $eventOrganizerCheck = $repository->update($eventOrganizerData, $eventOrganizerData->toFillableArray());
        $this->assertNotNull($eventOrganizerCheck);
    }

    public function testDelete()
    {
        $eventOrganizerData = factory(EventOrganizer::class)->create();

        /** @var  \App\Repositories\EventOrganizerRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\EventOrganizerRepositoryInterface::class);
        $this->assertNotNull($repository);

        $repository->delete($eventOrganizerData);

        $eventOrganizerCheck = $repository->find($eventOrganizerData->id);
        $this->assertNull($eventOrganizerCheck);
    }

}
