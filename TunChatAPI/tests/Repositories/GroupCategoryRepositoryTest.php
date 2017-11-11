<?php

namespace Tests\Repositories;

use App\Models\GroupCategory;
use Tests\TestCase;

class GroupCategoryRepositoryTest extends TestCase
{
    protected $useDatabase = true;

    public function testGetInstance()
    {
        /** @var  \App\Repositories\GroupCategoryRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\GroupCategoryRepositoryInterface::class);
        $this->assertNotNull($repository);
    }

    public function testGetList()
    {
        $models = factory(GroupCategory::class, 3)->create();
        $groupCategoryIds = $models->pluck('id')->toArray();

        /** @var  \App\Repositories\GroupCategoryRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\GroupCategoryRepositoryInterface::class);
        $this->assertNotNull($repository);

        $modelsCheck = $repository->get('id', 'asc', 0, 1);
        $this->assertInstanceOf(GroupCategory::class, $modelsCheck[0]);

        $modelsCheck = $repository->getByIds($groupCategoryIds);
        $this->assertEquals(3, count($modelsCheck));
    }

    public function testFind()
    {
        $models = factory(GroupCategory::class, 3)->create();
        $groupCategoryIds = $models->pluck('id')->toArray();

        /** @var  \App\Repositories\GroupCategoryRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\GroupCategoryRepositoryInterface::class);
        $this->assertNotNull($repository);

        $groupCategoryCheck = $repository->find($groupCategoryIds[0]);
        $this->assertEquals($groupCategoryIds[0], $groupCategoryCheck->id);
    }

    public function testCreate()
    {
        $groupCategoryData = factory(GroupCategory::class)->make();

        /** @var  \App\Repositories\GroupCategoryRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\GroupCategoryRepositoryInterface::class);
        $this->assertNotNull($repository);

        $groupCategoryCheck = $repository->create($groupCategoryData->toFillableArray());
        $this->assertNotNull($groupCategoryCheck);
    }

    public function testUpdate()
    {
        $groupCategoryData = factory(GroupCategory::class)->create();

        /** @var  \App\Repositories\GroupCategoryRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\GroupCategoryRepositoryInterface::class);
        $this->assertNotNull($repository);

        $groupCategoryCheck = $repository->update($groupCategoryData, $groupCategoryData->toFillableArray());
        $this->assertNotNull($groupCategoryCheck);
    }

    public function testDelete()
    {
        $groupCategoryData = factory(GroupCategory::class)->create();

        /** @var  \App\Repositories\GroupCategoryRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\GroupCategoryRepositoryInterface::class);
        $this->assertNotNull($repository);

        $repository->delete($groupCategoryData);

        $groupCategoryCheck = $repository->find($groupCategoryData->id);
        $this->assertNull($groupCategoryCheck);
    }

}
