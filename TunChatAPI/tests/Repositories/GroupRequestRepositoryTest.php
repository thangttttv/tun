<?php

namespace Tests\Repositories;

use App\Models\GroupRequest;
use Tests\TestCase;

class GroupRequestRepositoryTest extends TestCase
{
    protected $useDatabase = true;

    public function testGetInstance()
    {
        /** @var  \App\Repositories\GroupRequestRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\GroupRequestRepositoryInterface::class);
        $this->assertNotNull($repository);
    }

    public function testGetList()
    {
        $models = factory(GroupRequest::class, 3)->create();
        $groupRequestIds = $models->pluck('id')->toArray();

        /** @var  \App\Repositories\GroupRequestRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\GroupRequestRepositoryInterface::class);
        $this->assertNotNull($repository);

        $modelsCheck = $repository->get('id', 'asc', 0, 1);
        $this->assertInstanceOf(GroupRequest::class, $modelsCheck[0]);

        $modelsCheck = $repository->getByIds($groupRequestIds);
        $this->assertEquals(3, count($modelsCheck));
    }

    public function testFind()
    {
        $models = factory(GroupRequest::class, 3)->create();
        $groupRequestIds = $models->pluck('id')->toArray();

        /** @var  \App\Repositories\GroupRequestRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\GroupRequestRepositoryInterface::class);
        $this->assertNotNull($repository);

        $groupRequestCheck = $repository->find($groupRequestIds[0]);
        $this->assertEquals($groupRequestIds[0], $groupRequestCheck->id);
    }

    public function testCreate()
    {
        $groupRequestData = factory(GroupRequest::class)->make();

        /** @var  \App\Repositories\GroupRequestRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\GroupRequestRepositoryInterface::class);
        $this->assertNotNull($repository);

        $groupRequestCheck = $repository->create($groupRequestData->toFillableArray());
        $this->assertNotNull($groupRequestCheck);
    }

    public function testUpdate()
    {
        $groupRequestData = factory(GroupRequest::class)->create();

        /** @var  \App\Repositories\GroupRequestRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\GroupRequestRepositoryInterface::class);
        $this->assertNotNull($repository);

        $groupRequestCheck = $repository->update($groupRequestData, $groupRequestData->toFillableArray());
        $this->assertNotNull($groupRequestCheck);
    }

    public function testDelete()
    {
        $groupRequestData = factory(GroupRequest::class)->create();

        /** @var  \App\Repositories\GroupRequestRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\GroupRequestRepositoryInterface::class);
        $this->assertNotNull($repository);

        $repository->delete($groupRequestData);

        $groupRequestCheck = $repository->find($groupRequestData->id);
        $this->assertNull($groupRequestCheck);
    }

}
