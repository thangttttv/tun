<?php

namespace Tests\Repositories;

use App\Models\Page;
use Tests\TestCase;

class PageRepositoryTest extends TestCase
{
    protected $useDatabase = true;

    public function testGetInstance()
    {
        /** @var  \App\Repositories\PageRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\PageRepositoryInterface::class);
        $this->assertNotNull($repository);
    }

    public function testGetList()
    {
        $models = factory(Page::class, 3)->create();
        $pageIds = $models->pluck('id')->toArray();

        /** @var  \App\Repositories\PageRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\PageRepositoryInterface::class);
        $this->assertNotNull($repository);

        $modelsCheck = $repository->get('id', 'asc', 0, 1);
        $this->assertInstanceOf(Page::class, $modelsCheck[0]);

        $modelsCheck = $repository->getByIds($pageIds);
        $this->assertEquals(3, count($modelsCheck));
    }

    public function testFind()
    {
        $models = factory(Page::class, 3)->create();
        $pageIds = $models->pluck('id')->toArray();

        /** @var  \App\Repositories\PageRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\PageRepositoryInterface::class);
        $this->assertNotNull($repository);

        $pageCheck = $repository->find($pageIds[0]);
        $this->assertEquals($pageIds[0], $pageCheck->id);
    }

    public function testCreate()
    {
        $pageData = factory(Page::class)->make();

        /** @var  \App\Repositories\PageRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\PageRepositoryInterface::class);
        $this->assertNotNull($repository);

        $pageCheck = $repository->create($pageData->toFillableArray());
        $this->assertNotNull($pageCheck);
    }

    public function testUpdate()
    {
        $pageData = factory(Page::class)->create();

        /** @var  \App\Repositories\PageRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\PageRepositoryInterface::class);
        $this->assertNotNull($repository);

        $pageCheck = $repository->update($pageData, $pageData->toFillableArray());
        $this->assertNotNull($pageCheck);
    }

    public function testDelete()
    {
        $pageData = factory(Page::class)->create();

        /** @var  \App\Repositories\PageRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\PageRepositoryInterface::class);
        $this->assertNotNull($repository);

        $repository->delete($pageData);

        $pageCheck = $repository->find($pageData->id);
        $this->assertNull($pageCheck);
    }

}
