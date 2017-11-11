<?php

namespace Tests\Repositories;

use App\Models\Group;
use Tests\TestCase;

class GroupRepositoryTest extends TestCase
{
    protected $useDatabase = true;

    public function testGetInstance()
    {
        /** @var  \App\Repositories\GroupRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\GroupRepositoryInterface::class);
        $this->assertNotNull($repository);
    }

    public function testGetList()
    {
        $models = factory(Group::class, 3)->create();
        $groupIds = $models->pluck('id')->toArray();

        /** @var  \App\Repositories\GroupRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\GroupRepositoryInterface::class);
        $this->assertNotNull($repository);

        $modelsCheck = $repository->get('id', 'asc', 0, 1);
        $this->assertInstanceOf(Group::class, $modelsCheck[0]);

        $modelsCheck = $repository->getByIds($groupIds);
        $this->assertEquals(3, count($modelsCheck));
    }

    public function testFind()
    {
        $models = factory(Group::class, 3)->create();
        $groupIds = $models->pluck('id')->toArray();

        /** @var  \App\Repositories\GroupRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\GroupRepositoryInterface::class);
        $this->assertNotNull($repository);

        $groupCheck = $repository->find($groupIds[0]);
        $this->assertEquals($groupIds[0], $groupCheck->id);
    }

    public function testCreate()
    {
        $groupData = factory(Group::class)->make();

        /** @var  \App\Repositories\GroupRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\GroupRepositoryInterface::class);
        $this->assertNotNull($repository);

        $groupCheck = $repository->create($groupData->toFillableArray());
        $this->assertNotNull($groupCheck);
    }

    public function testUpdate()
    {
        $groupData = factory(Group::class)->create();

        /** @var  \App\Repositories\GroupRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\GroupRepositoryInterface::class);
        $this->assertNotNull($repository);

        $groupCheck = $repository->update($groupData, $groupData->toFillableArray());
        $this->assertNotNull($groupCheck);
    }

    public function testDelete()
    {
        $groupData = factory(Group::class)->create();

        /** @var  \App\Repositories\GroupRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\GroupRepositoryInterface::class);
        $this->assertNotNull($repository);

        $repository->delete($groupData);

        $groupCheck = $repository->find($groupData->id);
        $this->assertNull($groupCheck);
    }

}
