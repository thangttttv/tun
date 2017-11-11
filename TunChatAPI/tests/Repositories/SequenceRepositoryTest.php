<?php

namespace Tests\Repositories;

use App\Models\Sequence;
use Tests\TestCase;

class SequenceRepositoryTest extends TestCase
{
    protected $useDatabase = true;

    public function testGetInstance()
    {
        /** @var  \App\Repositories\SequenceRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\SequenceRepositoryInterface::class);
        $this->assertNotNull($repository);
    }

    public function testGetList()
    {
        $models = factory(Sequence::class, 3)->create();
        $sequenceIds = $models->pluck('id')->toArray();

        /** @var  \App\Repositories\SequenceRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\SequenceRepositoryInterface::class);
        $this->assertNotNull($repository);

        $modelsCheck = $repository->get('id', 'asc', 0, 1);
        $this->assertInstanceOf(Sequence::class, $modelsCheck[0]);

        $modelsCheck = $repository->getByIds($sequenceIds);
        $this->assertEquals(3, count($modelsCheck));
    }

    public function testFind()
    {
        $models = factory(Sequence::class, 3)->create();
        $sequenceIds = $models->pluck('id')->toArray();

        /** @var  \App\Repositories\SequenceRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\SequenceRepositoryInterface::class);
        $this->assertNotNull($repository);

        $sequenceCheck = $repository->find($sequenceIds[0]);
        $this->assertEquals($sequenceIds[0], $sequenceCheck->id);
    }

    public function testCreate()
    {
        $sequenceData = factory(Sequence::class)->make();

        /** @var  \App\Repositories\SequenceRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\SequenceRepositoryInterface::class);
        $this->assertNotNull($repository);

        $sequenceCheck = $repository->create($sequenceData->toFillableArray());
        $this->assertNotNull($sequenceCheck);
    }

    public function testUpdate()
    {
        $sequenceData = factory(Sequence::class)->create();

        /** @var  \App\Repositories\SequenceRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\SequenceRepositoryInterface::class);
        $this->assertNotNull($repository);

        $sequenceCheck = $repository->update($sequenceData, $sequenceData->toFillableArray());
        $this->assertNotNull($sequenceCheck);
    }

    public function testDelete()
    {
        $sequenceData = factory(Sequence::class)->create();

        /** @var  \App\Repositories\SequenceRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\SequenceRepositoryInterface::class);
        $this->assertNotNull($repository);

        $repository->delete($sequenceData);

        $sequenceCheck = $repository->find($sequenceData->id);
        $this->assertNull($sequenceCheck);
    }

}
