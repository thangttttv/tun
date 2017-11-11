<?php

namespace Tests\Repositories;

use App\Models\SequenceCustomer;
use Tests\TestCase;

class SequenceCustomerRepositoryTest extends TestCase
{
    protected $useDatabase = true;

    public function testGetInstance()
    {
        /** @var  \App\Repositories\SequenceCustomerRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\SequenceCustomerRepositoryInterface::class);
        $this->assertNotNull($repository);
    }

    public function testGetList()
    {
        $models = factory(SequenceCustomer::class, 3)->create();
        $sequenceCustomerIds = $models->pluck('id')->toArray();

        /** @var  \App\Repositories\SequenceCustomerRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\SequenceCustomerRepositoryInterface::class);
        $this->assertNotNull($repository);

        $modelsCheck = $repository->get('id', 'asc', 0, 1);
        $this->assertInstanceOf(SequenceCustomer::class, $modelsCheck[0]);

        $modelsCheck = $repository->getByIds($sequenceCustomerIds);
        $this->assertEquals(3, count($modelsCheck));
    }

    public function testFind()
    {
        $models = factory(SequenceCustomer::class, 3)->create();
        $sequenceCustomerIds = $models->pluck('id')->toArray();

        /** @var  \App\Repositories\SequenceCustomerRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\SequenceCustomerRepositoryInterface::class);
        $this->assertNotNull($repository);

        $sequenceCustomerCheck = $repository->find($sequenceCustomerIds[0]);
        $this->assertEquals($sequenceCustomerIds[0], $sequenceCustomerCheck->id);
    }

    public function testCreate()
    {
        $sequenceCustomerData = factory(SequenceCustomer::class)->make();

        /** @var  \App\Repositories\SequenceCustomerRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\SequenceCustomerRepositoryInterface::class);
        $this->assertNotNull($repository);

        $sequenceCustomerCheck = $repository->create($sequenceCustomerData->toFillableArray());
        $this->assertNotNull($sequenceCustomerCheck);
    }

    public function testUpdate()
    {
        $sequenceCustomerData = factory(SequenceCustomer::class)->create();

        /** @var  \App\Repositories\SequenceCustomerRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\SequenceCustomerRepositoryInterface::class);
        $this->assertNotNull($repository);

        $sequenceCustomerCheck = $repository->update($sequenceCustomerData, $sequenceCustomerData->toFillableArray());
        $this->assertNotNull($sequenceCustomerCheck);
    }

    public function testDelete()
    {
        $sequenceCustomerData = factory(SequenceCustomer::class)->create();

        /** @var  \App\Repositories\SequenceCustomerRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\SequenceCustomerRepositoryInterface::class);
        $this->assertNotNull($repository);

        $repository->delete($sequenceCustomerData);

        $sequenceCustomerCheck = $repository->find($sequenceCustomerData->id);
        $this->assertNull($sequenceCustomerCheck);
    }

}
