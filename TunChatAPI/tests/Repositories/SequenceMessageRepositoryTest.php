<?php

namespace Tests\Repositories;

use App\Models\SequenceMessage;
use Tests\TestCase;

class SequenceMessageRepositoryTest extends TestCase
{
    protected $useDatabase = true;

    public function testGetInstance()
    {
        /** @var  \App\Repositories\SequenceMessageRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\SequenceMessageRepositoryInterface::class);
        $this->assertNotNull($repository);
    }

    public function testGetList()
    {
        $models = factory(SequenceMessage::class, 3)->create();
        $sequenceMessageIds = $models->pluck('id')->toArray();

        /** @var  \App\Repositories\SequenceMessageRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\SequenceMessageRepositoryInterface::class);
        $this->assertNotNull($repository);

        $modelsCheck = $repository->get('id', 'asc', 0, 1);
        $this->assertInstanceOf(SequenceMessage::class, $modelsCheck[0]);

        $modelsCheck = $repository->getByIds($sequenceMessageIds);
        $this->assertEquals(3, count($modelsCheck));
    }

    public function testFind()
    {
        $models = factory(SequenceMessage::class, 3)->create();
        $sequenceMessageIds = $models->pluck('id')->toArray();

        /** @var  \App\Repositories\SequenceMessageRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\SequenceMessageRepositoryInterface::class);
        $this->assertNotNull($repository);

        $sequenceMessageCheck = $repository->find($sequenceMessageIds[0]);
        $this->assertEquals($sequenceMessageIds[0], $sequenceMessageCheck->id);
    }

    public function testCreate()
    {
        $sequenceMessageData = factory(SequenceMessage::class)->make();

        /** @var  \App\Repositories\SequenceMessageRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\SequenceMessageRepositoryInterface::class);
        $this->assertNotNull($repository);

        $sequenceMessageCheck = $repository->create($sequenceMessageData->toFillableArray());
        $this->assertNotNull($sequenceMessageCheck);
    }

    public function testUpdate()
    {
        $sequenceMessageData = factory(SequenceMessage::class)->create();

        /** @var  \App\Repositories\SequenceMessageRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\SequenceMessageRepositoryInterface::class);
        $this->assertNotNull($repository);

        $sequenceMessageCheck = $repository->update($sequenceMessageData, $sequenceMessageData->toFillableArray());
        $this->assertNotNull($sequenceMessageCheck);
    }

    public function testDelete()
    {
        $sequenceMessageData = factory(SequenceMessage::class)->create();

        /** @var  \App\Repositories\SequenceMessageRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\SequenceMessageRepositoryInterface::class);
        $this->assertNotNull($repository);

        $repository->delete($sequenceMessageData);

        $sequenceMessageCheck = $repository->find($sequenceMessageData->id);
        $this->assertNull($sequenceMessageCheck);
    }

}
