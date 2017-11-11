<?php

namespace Tests\Repositories;

use App\Models\XUserPoint;
use Tests\TestCase;

class XUserPointRepositoryTest extends TestCase
{
    protected $useDatabase = true;

    public function testGetInstance()
    {
        /** @var  \App\Repositories\XUserPointRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\XUserPointRepositoryInterface::class);
        $this->assertNotNull($repository);
    }

    public function testGetList()
    {
        $models = factory(XUserPoint::class, 3)->create();
        $xUserPointIds = $models->pluck('id')->toArray();

        /** @var  \App\Repositories\XUserPointRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\XUserPointRepositoryInterface::class);
        $this->assertNotNull($repository);

        $modelsCheck = $repository->get('id', 'asc', 0, 1);
        $this->assertInstanceOf(XUserPoint::class, $modelsCheck[0]);

        $modelsCheck = $repository->getByIds($xUserPointIds);
        $this->assertEquals(3, count($modelsCheck));
    }

    public function testFind()
    {
        $models = factory(XUserPoint::class, 3)->create();
        $xUserPointIds = $models->pluck('id')->toArray();

        /** @var  \App\Repositories\XUserPointRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\XUserPointRepositoryInterface::class);
        $this->assertNotNull($repository);

        $xUserPointCheck = $repository->find($xUserPointIds[0]);
        $this->assertEquals($xUserPointIds[0], $xUserPointCheck->id);
    }

    public function testCreate()
    {
        $xUserPointData = factory(XUserPoint::class)->make();

        /** @var  \App\Repositories\XUserPointRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\XUserPointRepositoryInterface::class);
        $this->assertNotNull($repository);

        $xUserPointCheck = $repository->create($xUserPointData->toFillableArray());
        $this->assertNotNull($xUserPointCheck);
    }

    public function testUpdate()
    {
        $xUserPointData = factory(XUserPoint::class)->create();

        /** @var  \App\Repositories\XUserPointRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\XUserPointRepositoryInterface::class);
        $this->assertNotNull($repository);

        $xUserPointCheck = $repository->update($xUserPointData, $xUserPointData->toFillableArray());
        $this->assertNotNull($xUserPointCheck);
    }

    public function testDelete()
    {
        $xUserPointData = factory(XUserPoint::class)->create();

        /** @var  \App\Repositories\XUserPointRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\XUserPointRepositoryInterface::class);
        $this->assertNotNull($repository);

        $repository->delete($xUserPointData);

        $xUserPointCheck = $repository->find($xUserPointData->id);
        $this->assertNull($xUserPointCheck);
    }

}
