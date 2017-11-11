<?php

namespace Tests\Repositories;

use App\Models\EventTicket;
use Tests\TestCase;

class EventTicketRepositoryTest extends TestCase
{
    protected $useDatabase = true;

    public function testGetInstance()
    {
        /** @var  \App\Repositories\EventTicketRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\EventTicketRepositoryInterface::class);
        $this->assertNotNull($repository);
    }

    public function testGetList()
    {
        $models = factory(EventTicket::class, 3)->create();
        $eventTicketIds = $models->pluck('id')->toArray();

        /** @var  \App\Repositories\EventTicketRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\EventTicketRepositoryInterface::class);
        $this->assertNotNull($repository);

        $modelsCheck = $repository->get('id', 'asc', 0, 1);
        $this->assertInstanceOf(EventTicket::class, $modelsCheck[0]);

        $modelsCheck = $repository->getByIds($eventTicketIds);
        $this->assertEquals(3, count($modelsCheck));
    }

    public function testFind()
    {
        $models = factory(EventTicket::class, 3)->create();
        $eventTicketIds = $models->pluck('id')->toArray();

        /** @var  \App\Repositories\EventTicketRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\EventTicketRepositoryInterface::class);
        $this->assertNotNull($repository);

        $eventTicketCheck = $repository->find($eventTicketIds[0]);
        $this->assertEquals($eventTicketIds[0], $eventTicketCheck->id);
    }

    public function testCreate()
    {
        $eventTicketData = factory(EventTicket::class)->make();

        /** @var  \App\Repositories\EventTicketRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\EventTicketRepositoryInterface::class);
        $this->assertNotNull($repository);

        $eventTicketCheck = $repository->create($eventTicketData->toFillableArray());
        $this->assertNotNull($eventTicketCheck);
    }

    public function testUpdate()
    {
        $eventTicketData = factory(EventTicket::class)->create();

        /** @var  \App\Repositories\EventTicketRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\EventTicketRepositoryInterface::class);
        $this->assertNotNull($repository);

        $eventTicketCheck = $repository->update($eventTicketData, $eventTicketData->toFillableArray());
        $this->assertNotNull($eventTicketCheck);
    }

    public function testDelete()
    {
        $eventTicketData = factory(EventTicket::class)->create();

        /** @var  \App\Repositories\EventTicketRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\EventTicketRepositoryInterface::class);
        $this->assertNotNull($repository);

        $repository->delete($eventTicketData);

        $eventTicketCheck = $repository->find($eventTicketData->id);
        $this->assertNull($eventTicketCheck);
    }

}
