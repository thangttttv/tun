<?php

namespace Tests\Repositories;

use App\Models\EventImage;
use Tests\TestCase;

class EventImageRepositoryTest extends TestCase
{
    protected $useDatabase = true;

    public function testGetInstance()
    {
        /** @var  \App\Repositories\EventImageRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\EventImageRepositoryInterface::class);
        $this->assertNotNull($repository);
    }

    public function testGetList()
    {
        $models = factory(EventImage::class, 3)->create();
        $eventImageIds = $models->pluck('id')->toArray();

        /** @var  \App\Repositories\EventImageRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\EventImageRepositoryInterface::class);
        $this->assertNotNull($repository);

        $modelsCheck = $repository->get('id', 'asc', 0, 1);
        $this->assertInstanceOf(EventImage::class, $modelsCheck[0]);

        $modelsCheck = $repository->getByIds($eventImageIds);
        $this->assertEquals(3, count($modelsCheck));
    }

    public function testFind()
    {
        $models = factory(EventImage::class, 3)->create();
        $eventImageIds = $models->pluck('id')->toArray();

        /** @var  \App\Repositories\EventImageRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\EventImageRepositoryInterface::class);
        $this->assertNotNull($repository);

        $eventImageCheck = $repository->find($eventImageIds[0]);
        $this->assertEquals($eventImageIds[0], $eventImageCheck->id);
    }

    public function testCreate()
    {
        $eventImageData = factory(EventImage::class)->make();

        /** @var  \App\Repositories\EventImageRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\EventImageRepositoryInterface::class);
        $this->assertNotNull($repository);

        $eventImageCheck = $repository->create($eventImageData->toFillableArray());
        $this->assertNotNull($eventImageCheck);
    }

    public function testUpdate()
    {
        $eventImageData = factory(EventImage::class)->create();

        /** @var  \App\Repositories\EventImageRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\EventImageRepositoryInterface::class);
        $this->assertNotNull($repository);

        $eventImageCheck = $repository->update($eventImageData, $eventImageData->toFillableArray());
        $this->assertNotNull($eventImageCheck);
    }

    public function testDelete()
    {
        $eventImageData = factory(EventImage::class)->create();

        /** @var  \App\Repositories\EventImageRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\EventImageRepositoryInterface::class);
        $this->assertNotNull($repository);

        $repository->delete($eventImageData);

        $eventImageCheck = $repository->find($eventImageData->id);
        $this->assertNull($eventImageCheck);
    }

}
