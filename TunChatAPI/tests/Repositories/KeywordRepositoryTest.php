<?php

namespace Tests\Repositories;

use App\Models\Keyword;
use Tests\TestCase;

class KeywordRepositoryTest extends TestCase
{
    protected $useDatabase = true;

    public function testGetInstance()
    {
        /** @var  \App\Repositories\KeywordRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\KeywordRepositoryInterface::class);
        $this->assertNotNull($repository);
    }

    public function testGetList()
    {
        $models = factory(Keyword::class, 3)->create();
        $keywordIds = $models->pluck('id')->toArray();

        /** @var  \App\Repositories\KeywordRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\KeywordRepositoryInterface::class);
        $this->assertNotNull($repository);

        $modelsCheck = $repository->get('id', 'asc', 0, 1);
        $this->assertInstanceOf(Keyword::class, $modelsCheck[0]);

        $modelsCheck = $repository->getByIds($keywordIds);
        $this->assertEquals(3, count($modelsCheck));
    }

    public function testFind()
    {
        $models = factory(Keyword::class, 3)->create();
        $keywordIds = $models->pluck('id')->toArray();

        /** @var  \App\Repositories\KeywordRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\KeywordRepositoryInterface::class);
        $this->assertNotNull($repository);

        $keywordCheck = $repository->find($keywordIds[0]);
        $this->assertEquals($keywordIds[0], $keywordCheck->id);
    }

    public function testCreate()
    {
        $keywordData = factory(Keyword::class)->make();

        /** @var  \App\Repositories\KeywordRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\KeywordRepositoryInterface::class);
        $this->assertNotNull($repository);

        $keywordCheck = $repository->create($keywordData->toFillableArray());
        $this->assertNotNull($keywordCheck);
    }

    public function testUpdate()
    {
        $keywordData = factory(Keyword::class)->create();

        /** @var  \App\Repositories\KeywordRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\KeywordRepositoryInterface::class);
        $this->assertNotNull($repository);

        $keywordCheck = $repository->update($keywordData, $keywordData->toFillableArray());
        $this->assertNotNull($keywordCheck);
    }

    public function testDelete()
    {
        $keywordData = factory(Keyword::class)->create();

        /** @var  \App\Repositories\KeywordRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\KeywordRepositoryInterface::class);
        $this->assertNotNull($repository);

        $repository->delete($keywordData);

        $keywordCheck = $repository->find($keywordData->id);
        $this->assertNull($keywordCheck);
    }

}
