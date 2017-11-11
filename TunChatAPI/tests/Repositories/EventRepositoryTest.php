<?php

namespace Tests\Repositories;

use App\Models\Event;
use Tests\TestCase;

class EventRepositoryTest extends TestCase
{
    protected $useDatabase = true;

    public function testGetInstance()
    {
        /** @var  \App\Repositories\EventRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\EventRepositoryInterface::class);
        $this->assertNotNull($repository);
    }

    public function testGetList()
    {
        $models = factory(Event::class, 3)->create();
        $eventIds = $models->pluck('id')->toArray();

        /** @var  \App\Repositories\EventRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\EventRepositoryInterface::class);
        $this->assertNotNull($repository);

        $modelsCheck = $repository->get('id', 'asc', 0, 1);
        $this->assertInstanceOf(Event::class, $modelsCheck[0]);

        $modelsCheck = $repository->getByIds($eventIds);
        $this->assertEquals(3, count($modelsCheck));
    }

    public function testFind()
    {
        $models = factory(Event::class, 3)->create();
        $eventIds = $models->pluck('id')->toArray();

        /** @var  \App\Repositories\EventRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\EventRepositoryInterface::class);
        $this->assertNotNull($repository);

        $eventCheck = $repository->find($eventIds[0]);
        $this->assertEquals($eventIds[0], $eventCheck->id);
    }

    public function testCreate()
    {
        $eventData = factory(Event::class)->make();

        /** @var  \App\Repositories\EventRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\EventRepositoryInterface::class);
        $this->assertNotNull($repository);

        $eventCheck = $repository->create($eventData->toFillableArray());
        $this->assertNotNull($eventCheck);
    }

    public function testUpdate()
    {
        $eventData = factory(Event::class)->create();

        /** @var  \App\Repositories\EventRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\EventRepositoryInterface::class);
        $this->assertNotNull($repository);

        $eventCheck = $repository->update($eventData, $eventData->toFillableArray());
        $this->assertNotNull($eventCheck);
    }

    public function testDelete()
    {
        $eventData = factory(Event::class)->create();

        /** @var  \App\Repositories\EventRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\EventRepositoryInterface::class);
        $this->assertNotNull($repository);

        $repository->delete($eventData);

        $eventCheck = $repository->find($eventData->id);
        $this->assertNull($eventCheck);
    }

}
