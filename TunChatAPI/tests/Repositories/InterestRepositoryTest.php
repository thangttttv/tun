<?php

namespace Tests\Repositories;

use App\Models\Interest;
use Tests\TestCase;

class InterestRepositoryTest extends TestCase
{
    protected $useDatabase = true;

    public function testGetInstance()
    {
        /** @var  \App\Repositories\InterestRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\InterestRepositoryInterface::class);
        $this->assertNotNull($repository);
    }

    public function testGetList()
    {
        $models = factory(Interest::class, 3)->create();
        $interestIds = $models->pluck('id')->toArray();

        /** @var  \App\Repositories\InterestRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\InterestRepositoryInterface::class);
        $this->assertNotNull($repository);

        $modelsCheck = $repository->get('id', 'asc', 0, 1);
        $this->assertInstanceOf(Interest::class, $modelsCheck[0]);

        $modelsCheck = $repository->getByIds($interestIds);
        $this->assertEquals(3, count($modelsCheck));
    }

    public function testFind()
    {
        $models = factory(Interest::class, 3)->create();
        $interestIds = $models->pluck('id')->toArray();

        /** @var  \App\Repositories\InterestRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\InterestRepositoryInterface::class);
        $this->assertNotNull($repository);

        $interestCheck = $repository->find($interestIds[0]);
        $this->assertEquals($interestIds[0], $interestCheck->id);
    }

    public function testCreate()
    {
        $interestData = factory(Interest::class)->make();

        /** @var  \App\Repositories\InterestRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\InterestRepositoryInterface::class);
        $this->assertNotNull($repository);

        $interestCheck = $repository->create($interestData->toFillableArray());
        $this->assertNotNull($interestCheck);
    }

    public function testUpdate()
    {
        $interestData = factory(Interest::class)->create();

        /** @var  \App\Repositories\InterestRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\InterestRepositoryInterface::class);
        $this->assertNotNull($repository);

        $interestCheck = $repository->update($interestData, $interestData->toFillableArray());
        $this->assertNotNull($interestCheck);
    }

    public function testDelete()
    {
        $interestData = factory(Interest::class)->create();

        /** @var  \App\Repositories\InterestRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\InterestRepositoryInterface::class);
        $this->assertNotNull($repository);

        $repository->delete($interestData);

        $interestCheck = $repository->find($interestData->id);
        $this->assertNull($interestCheck);
    }

}
