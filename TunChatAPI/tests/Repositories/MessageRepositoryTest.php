<?php

namespace Tests\Repositories;

use App\Models\Message;
use Tests\TestCase;

class MessageRepositoryTest extends TestCase
{
    protected $useDatabase = true;

    public function testGetInstance()
    {
        /** @var  \App\Repositories\MessageRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\MessageRepositoryInterface::class);
        $this->assertNotNull($repository);
    }

    public function testGetList()
    {
        $models = factory(Message::class, 3)->create();
        $messageIds = $models->pluck('id')->toArray();

        /** @var  \App\Repositories\MessageRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\MessageRepositoryInterface::class);
        $this->assertNotNull($repository);

        $modelsCheck = $repository->get('id', 'asc', 0, 1);
        $this->assertInstanceOf(Message::class, $modelsCheck[0]);

        $modelsCheck = $repository->getByIds($messageIds);
        $this->assertEquals(3, count($modelsCheck));
    }

    public function testFind()
    {
        $models = factory(Message::class, 3)->create();
        $messageIds = $models->pluck('id')->toArray();

        /** @var  \App\Repositories\MessageRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\MessageRepositoryInterface::class);
        $this->assertNotNull($repository);

        $messageCheck = $repository->find($messageIds[0]);
        $this->assertEquals($messageIds[0], $messageCheck->id);
    }

    public function testCreate()
    {
        $messageData = factory(Message::class)->make();

        /** @var  \App\Repositories\MessageRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\MessageRepositoryInterface::class);
        $this->assertNotNull($repository);

        $messageCheck = $repository->create($messageData->toFillableArray());
        $this->assertNotNull($messageCheck);
    }

    public function testUpdate()
    {
        $messageData = factory(Message::class)->create();

        /** @var  \App\Repositories\MessageRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\MessageRepositoryInterface::class);
        $this->assertNotNull($repository);

        $messageCheck = $repository->update($messageData, $messageData->toFillableArray());
        $this->assertNotNull($messageCheck);
    }

    public function testDelete()
    {
        $messageData = factory(Message::class)->create();

        /** @var  \App\Repositories\MessageRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\MessageRepositoryInterface::class);
        $this->assertNotNull($repository);

        $repository->delete($messageData);

        $messageCheck = $repository->find($messageData->id);
        $this->assertNull($messageCheck);
    }

}
