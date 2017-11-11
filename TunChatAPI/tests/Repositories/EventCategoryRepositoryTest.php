<?php

namespace Tests\Repositories;

use App\Models\EventCategory;
use Tests\TestCase;

class EventCategoryRepositoryTest extends TestCase
{
    protected $useDatabase = true;

    public function testGetInstance()
    {
        /** @var  \App\Repositories\EventCategoryRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\EventCategoryRepositoryInterface::class);
        $this->assertNotNull($repository);
    }

    public function testGetList()
    {
        $models = factory(EventCategory::class, 3)->create();
        $eventCategoryIds = $models->pluck('id')->toArray();

        /** @var  \App\Repositories\EventCategoryRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\EventCategoryRepositoryInterface::class);
        $this->assertNotNull($repository);

        $modelsCheck = $repository->get('id', 'asc', 0, 1);
        $this->assertInstanceOf(EventCategory::class, $modelsCheck[0]);

        $modelsCheck = $repository->getByIds($eventCategoryIds);
        $this->assertEquals(3, count($modelsCheck));
    }

    public function testFind()
    {
        $models = factory(EventCategory::class, 3)->create();
        $eventCategoryIds = $models->pluck('id')->toArray();

        /** @var  \App\Repositories\EventCategoryRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\EventCategoryRepositoryInterface::class);
        $this->assertNotNull($repository);

        $eventCategoryCheck = $repository->find($eventCategoryIds[0]);
        $this->assertEquals($eventCategoryIds[0], $eventCategoryCheck->id);
    }

    public function testCreate()
    {
        $eventCategoryData = factory(EventCategory::class)->make();

        /** @var  \App\Repositories\EventCategoryRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\EventCategoryRepositoryInterface::class);
        $this->assertNotNull($repository);

        $eventCategoryCheck = $repository->create($eventCategoryData->toFillableArray());
        $this->assertNotNull($eventCategoryCheck);
    }

    public function testUpdate()
    {
        $eventCategoryData = factory(EventCategory::class)->create();

        /** @var  \App\Repositories\EventCategoryRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\EventCategoryRepositoryInterface::class);
        $this->assertNotNull($repository);

        $eventCategoryCheck = $repository->update($eventCategoryData, $eventCategoryData->toFillableArray());
        $this->assertNotNull($eventCategoryCheck);
    }

    public function testDelete()
    {
        $eventCategoryData = factory(EventCategory::class)->create();

        /** @var  \App\Repositories\EventCategoryRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\EventCategoryRepositoryInterface::class);
        $this->assertNotNull($repository);

        $repository->delete($eventCategoryData);

        $eventCategoryCheck = $repository->find($eventCategoryData->id);
        $this->assertNull($eventCategoryCheck);
    }

}
