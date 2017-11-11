<?php

namespace Tests\Repositories;

use App\Models\GroupUser;
use Tests\TestCase;

class GroupUserRepositoryTest extends TestCase
{
    protected $useDatabase = true;

    public function testGetInstance()
    {
        /** @var  \App\Repositories\GroupUserRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\GroupUserRepositoryInterface::class);
        $this->assertNotNull($repository);
    }

    public function testGetList()
    {
        $models = factory(GroupUser::class, 3)->create();
        $groupUserIds = $models->pluck('id')->toArray();

        /** @var  \App\Repositories\GroupUserRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\GroupUserRepositoryInterface::class);
        $this->assertNotNull($repository);

        $modelsCheck = $repository->get('id', 'asc', 0, 1);
        $this->assertInstanceOf(GroupUser::class, $modelsCheck[0]);

        $modelsCheck = $repository->getByIds($groupUserIds);
        $this->assertEquals(3, count($modelsCheck));
    }

    public function testFind()
    {
        $models = factory(GroupUser::class, 3)->create();
        $groupUserIds = $models->pluck('id')->toArray();

        /** @var  \App\Repositories\GroupUserRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\GroupUserRepositoryInterface::class);
        $this->assertNotNull($repository);

        $groupUserCheck = $repository->find($groupUserIds[0]);
        $this->assertEquals($groupUserIds[0], $groupUserCheck->id);
    }

    public function testCreate()
    {
        $groupUserData = factory(GroupUser::class)->make();

        /** @var  \App\Repositories\GroupUserRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\GroupUserRepositoryInterface::class);
        $this->assertNotNull($repository);

        $groupUserCheck = $repository->create($groupUserData->toFillableArray());
        $this->assertNotNull($groupUserCheck);
    }

    public function testUpdate()
    {
        $groupUserData = factory(GroupUser::class)->create();

        /** @var  \App\Repositories\GroupUserRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\GroupUserRepositoryInterface::class);
        $this->assertNotNull($repository);

        $groupUserCheck = $repository->update($groupUserData, $groupUserData->toFillableArray());
        $this->assertNotNull($groupUserCheck);
    }

    public function testDelete()
    {
        $groupUserData = factory(GroupUser::class)->create();

        /** @var  \App\Repositories\GroupUserRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\GroupUserRepositoryInterface::class);
        $this->assertNotNull($repository);

        $repository->delete($groupUserData);

        $groupUserCheck = $repository->find($groupUserData->id);
        $this->assertNull($groupUserCheck);
    }

}
