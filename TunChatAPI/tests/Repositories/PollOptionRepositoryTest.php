<?php

namespace Tests\Repositories;

use App\Models\PollOption;
use Tests\TestCase;

class PollOptionRepositoryTest extends TestCase
{
    protected $useDatabase = true;

    public function testGetInstance()
    {
        /** @var  \App\Repositories\PollOptionRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\PollOptionRepositoryInterface::class);
        $this->assertNotNull($repository);
    }

    public function testGetList()
    {
        $models = factory(PollOption::class, 3)->create();
        $pollOptionIds = $models->pluck('id')->toArray();

        /** @var  \App\Repositories\PollOptionRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\PollOptionRepositoryInterface::class);
        $this->assertNotNull($repository);

        $modelsCheck = $repository->get('id', 'asc', 0, 1);
        $this->assertInstanceOf(PollOption::class, $modelsCheck[0]);

        $modelsCheck = $repository->getByIds($pollOptionIds);
        $this->assertEquals(3, count($modelsCheck));
    }

    public function testFind()
    {
        $models = factory(PollOption::class, 3)->create();
        $pollOptionIds = $models->pluck('id')->toArray();

        /** @var  \App\Repositories\PollOptionRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\PollOptionRepositoryInterface::class);
        $this->assertNotNull($repository);

        $pollOptionCheck = $repository->find($pollOptionIds[0]);
        $this->assertEquals($pollOptionIds[0], $pollOptionCheck->id);
    }

    public function testCreate()
    {
        $pollOptionData = factory(PollOption::class)->make();

        /** @var  \App\Repositories\PollOptionRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\PollOptionRepositoryInterface::class);
        $this->assertNotNull($repository);

        $pollOptionCheck = $repository->create($pollOptionData->toFillableArray());
        $this->assertNotNull($pollOptionCheck);
    }

    public function testUpdate()
    {
        $pollOptionData = factory(PollOption::class)->create();

        /** @var  \App\Repositories\PollOptionRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\PollOptionRepositoryInterface::class);
        $this->assertNotNull($repository);

        $pollOptionCheck = $repository->update($pollOptionData, $pollOptionData->toFillableArray());
        $this->assertNotNull($pollOptionCheck);
    }

    public function testDelete()
    {
        $pollOptionData = factory(PollOption::class)->create();

        /** @var  \App\Repositories\PollOptionRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\PollOptionRepositoryInterface::class);
        $this->assertNotNull($repository);

        $repository->delete($pollOptionData);

        $pollOptionCheck = $repository->find($pollOptionData->id);
        $this->assertNull($pollOptionCheck);
    }

}
