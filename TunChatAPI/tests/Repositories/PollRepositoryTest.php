<?php

namespace Tests\Repositories;

use App\Models\Poll;
use Tests\TestCase;

class PollRepositoryTest extends TestCase
{
    protected $useDatabase = true;

    public function testGetInstance()
    {
        /** @var  \App\Repositories\PollRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\PollRepositoryInterface::class);
        $this->assertNotNull($repository);
    }

    public function testGetList()
    {
        $models = factory(Poll::class, 3)->create();
        $pollIds = $models->pluck('id')->toArray();

        /** @var  \App\Repositories\PollRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\PollRepositoryInterface::class);
        $this->assertNotNull($repository);

        $modelsCheck = $repository->get('id', 'asc', 0, 1);
        $this->assertInstanceOf(Poll::class, $modelsCheck[0]);

        $modelsCheck = $repository->getByIds($pollIds);
        $this->assertEquals(3, count($modelsCheck));
    }

    public function testFind()
    {
        $models = factory(Poll::class, 3)->create();
        $pollIds = $models->pluck('id')->toArray();

        /** @var  \App\Repositories\PollRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\PollRepositoryInterface::class);
        $this->assertNotNull($repository);

        $pollCheck = $repository->find($pollIds[0]);
        $this->assertEquals($pollIds[0], $pollCheck->id);
    }

    public function testCreate()
    {
        $pollData = factory(Poll::class)->make();

        /** @var  \App\Repositories\PollRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\PollRepositoryInterface::class);
        $this->assertNotNull($repository);

        $pollCheck = $repository->create($pollData->toFillableArray());
        $this->assertNotNull($pollCheck);
    }

    public function testUpdate()
    {
        $pollData = factory(Poll::class)->create();

        /** @var  \App\Repositories\PollRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\PollRepositoryInterface::class);
        $this->assertNotNull($repository);

        $pollCheck = $repository->update($pollData, $pollData->toFillableArray());
        $this->assertNotNull($pollCheck);
    }

    public function testDelete()
    {
        $pollData = factory(Poll::class)->create();

        /** @var  \App\Repositories\PollRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\PollRepositoryInterface::class);
        $this->assertNotNull($repository);

        $repository->delete($pollData);

        $pollCheck = $repository->find($pollData->id);
        $this->assertNull($pollCheck);
    }

}
