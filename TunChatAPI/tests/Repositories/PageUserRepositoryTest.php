<?php

namespace Tests\Repositories;

use App\Models\PageUser;
use Tests\TestCase;

class PageUserRepositoryTest extends TestCase
{
    protected $useDatabase = true;

    public function testGetInstance()
    {
        /** @var  \App\Repositories\PageUserRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\PageUserRepositoryInterface::class);
        $this->assertNotNull($repository);
    }

    public function testGetList()
    {
        $models = factory(PageUser::class, 3)->create();
        $pageUserIds = $models->pluck('id')->toArray();

        /** @var  \App\Repositories\PageUserRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\PageUserRepositoryInterface::class);
        $this->assertNotNull($repository);

        $modelsCheck = $repository->get('id', 'asc', 0, 1);
        $this->assertInstanceOf(PageUser::class, $modelsCheck[0]);

        $modelsCheck = $repository->getByIds($pageUserIds);
        $this->assertEquals(3, count($modelsCheck));
    }

    public function testFind()
    {
        $models = factory(PageUser::class, 3)->create();
        $pageUserIds = $models->pluck('id')->toArray();

        /** @var  \App\Repositories\PageUserRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\PageUserRepositoryInterface::class);
        $this->assertNotNull($repository);

        $pageUserCheck = $repository->find($pageUserIds[0]);
        $this->assertEquals($pageUserIds[0], $pageUserCheck->id);
    }

    public function testCreate()
    {
        $pageUserData = factory(PageUser::class)->make();

        /** @var  \App\Repositories\PageUserRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\PageUserRepositoryInterface::class);
        $this->assertNotNull($repository);

        $pageUserCheck = $repository->create($pageUserData->toFillableArray());
        $this->assertNotNull($pageUserCheck);
    }

    public function testUpdate()
    {
        $pageUserData = factory(PageUser::class)->create();

        /** @var  \App\Repositories\PageUserRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\PageUserRepositoryInterface::class);
        $this->assertNotNull($repository);

        $pageUserCheck = $repository->update($pageUserData, $pageUserData->toFillableArray());
        $this->assertNotNull($pageUserCheck);
    }

    public function testDelete()
    {
        $pageUserData = factory(PageUser::class)->create();

        /** @var  \App\Repositories\PageUserRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\PageUserRepositoryInterface::class);
        $this->assertNotNull($repository);

        $repository->delete($pageUserData);

        $pageUserCheck = $repository->find($pageUserData->id);
        $this->assertNull($pageUserCheck);
    }

}
