<?php

namespace Tests\Repositories;

use App\Models\KeywordAction;
use Tests\TestCase;

class KeywordActionRepositoryTest extends TestCase
{
    protected $useDatabase = true;

    public function testGetInstance()
    {
        /** @var  \App\Repositories\KeywordActionRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\KeywordActionRepositoryInterface::class);
        $this->assertNotNull($repository);
    }

    public function testGetList()
    {
        $models = factory(KeywordAction::class, 3)->create();
        $keywordActionIds = $models->pluck('id')->toArray();

        /** @var  \App\Repositories\KeywordActionRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\KeywordActionRepositoryInterface::class);
        $this->assertNotNull($repository);

        $modelsCheck = $repository->get('id', 'asc', 0, 1);
        $this->assertInstanceOf(KeywordAction::class, $modelsCheck[0]);

        $modelsCheck = $repository->getByIds($keywordActionIds);
        $this->assertEquals(3, count($modelsCheck));
    }

    public function testFind()
    {
        $models = factory(KeywordAction::class, 3)->create();
        $keywordActionIds = $models->pluck('id')->toArray();

        /** @var  \App\Repositories\KeywordActionRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\KeywordActionRepositoryInterface::class);
        $this->assertNotNull($repository);

        $keywordActionCheck = $repository->find($keywordActionIds[0]);
        $this->assertEquals($keywordActionIds[0], $keywordActionCheck->id);
    }

    public function testCreate()
    {
        $keywordActionData = factory(KeywordAction::class)->make();

        /** @var  \App\Repositories\KeywordActionRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\KeywordActionRepositoryInterface::class);
        $this->assertNotNull($repository);

        $keywordActionCheck = $repository->create($keywordActionData->toFillableArray());
        $this->assertNotNull($keywordActionCheck);
    }

    public function testUpdate()
    {
        $keywordActionData = factory(KeywordAction::class)->create();

        /** @var  \App\Repositories\KeywordActionRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\KeywordActionRepositoryInterface::class);
        $this->assertNotNull($repository);

        $keywordActionCheck = $repository->update($keywordActionData, $keywordActionData->toFillableArray());
        $this->assertNotNull($keywordActionCheck);
    }

    public function testDelete()
    {
        $keywordActionData = factory(KeywordAction::class)->create();

        /** @var  \App\Repositories\KeywordActionRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\KeywordActionRepositoryInterface::class);
        $this->assertNotNull($repository);

        $repository->delete($keywordActionData);

        $keywordActionCheck = $repository->find($keywordActionData->id);
        $this->assertNull($keywordActionCheck);
    }

}
