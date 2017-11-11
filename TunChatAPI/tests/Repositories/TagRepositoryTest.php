<?php

namespace Tests\Repositories;

use App\Models\Tag;
use Tests\TestCase;

class TagRepositoryTest extends TestCase
{
    protected $useDatabase = true;

    public function testGetInstance()
    {
        /** @var  \App\Repositories\TagRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\TagRepositoryInterface::class);
        $this->assertNotNull($repository);
    }

    public function testGetList()
    {
        $models = factory(Tag::class, 3)->create();
        $tagIds = $models->pluck('id')->toArray();

        /** @var  \App\Repositories\TagRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\TagRepositoryInterface::class);
        $this->assertNotNull($repository);

        $modelsCheck = $repository->get('id', 'asc', 0, 1);
        $this->assertInstanceOf(Tag::class, $modelsCheck[0]);

        $modelsCheck = $repository->getByIds($tagIds);
        $this->assertEquals(3, count($modelsCheck));
    }

    public function testFind()
    {
        $models = factory(Tag::class, 3)->create();
        $tagIds = $models->pluck('id')->toArray();

        /** @var  \App\Repositories\TagRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\TagRepositoryInterface::class);
        $this->assertNotNull($repository);

        $tagCheck = $repository->find($tagIds[0]);
        $this->assertEquals($tagIds[0], $tagCheck->id);
    }

    public function testCreate()
    {
        $tagData = factory(Tag::class)->make();

        /** @var  \App\Repositories\TagRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\TagRepositoryInterface::class);
        $this->assertNotNull($repository);

        $tagCheck = $repository->create($tagData->toFillableArray());
        $this->assertNotNull($tagCheck);
    }

    public function testUpdate()
    {
        $tagData = factory(Tag::class)->create();

        /** @var  \App\Repositories\TagRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\TagRepositoryInterface::class);
        $this->assertNotNull($repository);

        $tagCheck = $repository->update($tagData, $tagData->toFillableArray());
        $this->assertNotNull($tagCheck);
    }

    public function testDelete()
    {
        $tagData = factory(Tag::class)->create();

        /** @var  \App\Repositories\TagRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\TagRepositoryInterface::class);
        $this->assertNotNull($repository);

        $repository->delete($tagData);

        $tagCheck = $repository->find($tagData->id);
        $this->assertNull($tagCheck);
    }

}
