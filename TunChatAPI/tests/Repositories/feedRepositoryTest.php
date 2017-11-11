<?php

namespace Tests\Repositories;

use App\Models\feed;
use Tests\TestCase;

class feedRepositoryTest extends TestCase
{
    protected $useDatabase = true;

    public function testGetInstance()
    {
        /** @var  \App\Repositories\feedRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\feedRepositoryInterface::class);
        $this->assertNotNull($repository);
    }

    public function testGetList()
    {
        $models = factory(feed::class, 3)->create();
        $feedIds = $models->pluck('id')->toArray();

        /** @var  \App\Repositories\feedRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\feedRepositoryInterface::class);
        $this->assertNotNull($repository);

        $modelsCheck = $repository->get('id', 'asc', 0, 1);
        $this->assertInstanceOf(feed::class, $modelsCheck[0]);

        $modelsCheck = $repository->getByIds($feedIds);
        $this->assertEquals(3, count($modelsCheck));
    }

    public function testFind()
    {
        $models = factory(feed::class, 3)->create();
        $feedIds = $models->pluck('id')->toArray();

        /** @var  \App\Repositories\feedRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\feedRepositoryInterface::class);
        $this->assertNotNull($repository);

        $feedCheck = $repository->find($feedIds[0]);
        $this->assertEquals($feedIds[0], $feedCheck->id);
    }

    public function testCreate()
    {
        $feedData = factory(feed::class)->make();

        /** @var  \App\Repositories\feedRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\feedRepositoryInterface::class);
        $this->assertNotNull($repository);

        $feedCheck = $repository->create($feedData->toFillableArray());
        $this->assertNotNull($feedCheck);
    }

    public function testUpdate()
    {
        $feedData = factory(feed::class)->create();

        /** @var  \App\Repositories\feedRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\feedRepositoryInterface::class);
        $this->assertNotNull($repository);

        $feedCheck = $repository->update($feedData, $feedData->toFillableArray());
        $this->assertNotNull($feedCheck);
    }

    public function testDelete()
    {
        $feedData = factory(feed::class)->create();

        /** @var  \App\Repositories\feedRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\feedRepositoryInterface::class);
        $this->assertNotNull($repository);

        $repository->delete($feedData);

        $feedCheck = $repository->find($feedData->id);
        $this->assertNull($feedCheck);
    }

}
