<?php

namespace Tests\Repositories;

use App\Models\PollAnswer;
use Tests\TestCase;

class PollAnswerRepositoryTest extends TestCase
{
    protected $useDatabase = true;

    public function testGetInstance()
    {
        /** @var  \App\Repositories\PollAnswerRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\PollAnswerRepositoryInterface::class);
        $this->assertNotNull($repository);
    }

    public function testGetList()
    {
        $models = factory(PollAnswer::class, 3)->create();
        $pollAnswerIds = $models->pluck('id')->toArray();

        /** @var  \App\Repositories\PollAnswerRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\PollAnswerRepositoryInterface::class);
        $this->assertNotNull($repository);

        $modelsCheck = $repository->get('id', 'asc', 0, 1);
        $this->assertInstanceOf(PollAnswer::class, $modelsCheck[0]);

        $modelsCheck = $repository->getByIds($pollAnswerIds);
        $this->assertEquals(3, count($modelsCheck));
    }

    public function testFind()
    {
        $models = factory(PollAnswer::class, 3)->create();
        $pollAnswerIds = $models->pluck('id')->toArray();

        /** @var  \App\Repositories\PollAnswerRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\PollAnswerRepositoryInterface::class);
        $this->assertNotNull($repository);

        $pollAnswerCheck = $repository->find($pollAnswerIds[0]);
        $this->assertEquals($pollAnswerIds[0], $pollAnswerCheck->id);
    }

    public function testCreate()
    {
        $pollAnswerData = factory(PollAnswer::class)->make();

        /** @var  \App\Repositories\PollAnswerRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\PollAnswerRepositoryInterface::class);
        $this->assertNotNull($repository);

        $pollAnswerCheck = $repository->create($pollAnswerData->toFillableArray());
        $this->assertNotNull($pollAnswerCheck);
    }

    public function testUpdate()
    {
        $pollAnswerData = factory(PollAnswer::class)->create();

        /** @var  \App\Repositories\PollAnswerRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\PollAnswerRepositoryInterface::class);
        $this->assertNotNull($repository);

        $pollAnswerCheck = $repository->update($pollAnswerData, $pollAnswerData->toFillableArray());
        $this->assertNotNull($pollAnswerCheck);
    }

    public function testDelete()
    {
        $pollAnswerData = factory(PollAnswer::class)->create();

        /** @var  \App\Repositories\PollAnswerRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\PollAnswerRepositoryInterface::class);
        $this->assertNotNull($repository);

        $repository->delete($pollAnswerData);

        $pollAnswerCheck = $repository->find($pollAnswerData->id);
        $this->assertNull($pollAnswerCheck);
    }

}
