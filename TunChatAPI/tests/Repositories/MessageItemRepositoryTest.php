<?php

namespace Tests\Repositories;

use App\Models\MessageItem;
use Tests\TestCase;

class MessageItemRepositoryTest extends TestCase
{
    protected $useDatabase = true;

    public function testGetInstance()
    {
        /** @var  \App\Repositories\MessageItemRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\MessageItemRepositoryInterface::class);
        $this->assertNotNull($repository);
    }

    public function testGetList()
    {
        $models = factory(MessageItem::class, 3)->create();
        $messageItemIds = $models->pluck('id')->toArray();

        /** @var  \App\Repositories\MessageItemRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\MessageItemRepositoryInterface::class);
        $this->assertNotNull($repository);

        $modelsCheck = $repository->get('id', 'asc', 0, 1);
        $this->assertInstanceOf(MessageItem::class, $modelsCheck[0]);

        $modelsCheck = $repository->getByIds($messageItemIds);
        $this->assertEquals(3, count($modelsCheck));
    }

    public function testFind()
    {
        $models = factory(MessageItem::class, 3)->create();
        $messageItemIds = $models->pluck('id')->toArray();

        /** @var  \App\Repositories\MessageItemRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\MessageItemRepositoryInterface::class);
        $this->assertNotNull($repository);

        $messageItemCheck = $repository->find($messageItemIds[0]);
        $this->assertEquals($messageItemIds[0], $messageItemCheck->id);
    }

    public function testCreate()
    {
        $messageItemData = factory(MessageItem::class)->make();

        /** @var  \App\Repositories\MessageItemRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\MessageItemRepositoryInterface::class);
        $this->assertNotNull($repository);

        $messageItemCheck = $repository->create($messageItemData->toFillableArray());
        $this->assertNotNull($messageItemCheck);
    }

    public function testUpdate()
    {
        $messageItemData = factory(MessageItem::class)->create();

        /** @var  \App\Repositories\MessageItemRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\MessageItemRepositoryInterface::class);
        $this->assertNotNull($repository);

        $messageItemCheck = $repository->update($messageItemData, $messageItemData->toFillableArray());
        $this->assertNotNull($messageItemCheck);
    }

    public function testDelete()
    {
        $messageItemData = factory(MessageItem::class)->create();

        /** @var  \App\Repositories\MessageItemRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\MessageItemRepositoryInterface::class);
        $this->assertNotNull($repository);

        $repository->delete($messageItemData);

        $messageItemCheck = $repository->find($messageItemData->id);
        $this->assertNull($messageItemCheck);
    }

}
