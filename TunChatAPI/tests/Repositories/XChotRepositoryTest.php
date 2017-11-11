<?php

namespace Tests\Repositories;

use App\Models\XChot;
use Tests\TestCase;

class XChotRepositoryTest extends TestCase
{
    protected $useDatabase = true;

    public function testGetInstance()
    {
        /** @var  \App\Repositories\XChotRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\XChotRepositoryInterface::class);
        $this->assertNotNull($repository);
    }

    public function testGetList()
    {
        $models = factory(XChot::class, 3)->create();
        $xChotIds = $models->pluck('id')->toArray();

        /** @var  \App\Repositories\XChotRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\XChotRepositoryInterface::class);
        $this->assertNotNull($repository);

        $modelsCheck = $repository->get('id', 'asc', 0, 1);
        $this->assertInstanceOf(XChot::class, $modelsCheck[0]);

        $modelsCheck = $repository->getByIds($xChotIds);
        $this->assertEquals(3, count($modelsCheck));
    }

    public function testFind()
    {
        $models = factory(XChot::class, 3)->create();
        $xChotIds = $models->pluck('id')->toArray();

        /** @var  \App\Repositories\XChotRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\XChotRepositoryInterface::class);
        $this->assertNotNull($repository);

        $xChotCheck = $repository->find($xChotIds[0]);
        $this->assertEquals($xChotIds[0], $xChotCheck->id);
    }

    public function testCreate()
    {
        $xChotData = factory(XChot::class)->make();

        /** @var  \App\Repositories\XChotRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\XChotRepositoryInterface::class);
        $this->assertNotNull($repository);

        $xChotCheck = $repository->create($xChotData->toFillableArray());
        $this->assertNotNull($xChotCheck);
    }

    public function testUpdate()
    {
        $xChotData = factory(XChot::class)->create();

        /** @var  \App\Repositories\XChotRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\XChotRepositoryInterface::class);
        $this->assertNotNull($repository);

        $xChotCheck = $repository->update($xChotData, $xChotData->toFillableArray());
        $this->assertNotNull($xChotCheck);
    }

    public function testDelete()
    {
        $xChotData = factory(XChot::class)->create();

        /** @var  \App\Repositories\XChotRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\XChotRepositoryInterface::class);
        $this->assertNotNull($repository);

        $repository->delete($xChotData);

        $xChotCheck = $repository->find($xChotData->id);
        $this->assertNull($xChotCheck);
    }

}
