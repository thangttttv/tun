<?php

namespace Tests\Repositories;

use App\Models\ThongkeLotoDenky;
use Tests\TestCase;

class ThongkeLotoDenkyRepositoryTest extends TestCase
{
    protected $useDatabase = true;

    public function testGetInstance()
    {
        /** @var  \App\Repositories\ThongkeLotoDenkyRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\ThongkeLotoDenkyRepositoryInterface::class);
        $this->assertNotNull($repository);
    }

    public function testGetList()
    {
        $models = factory(ThongkeLotoDenky::class, 3)->create();
        $thongkeLotoDenkyIds = $models->pluck('id')->toArray();

        /** @var  \App\Repositories\ThongkeLotoDenkyRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\ThongkeLotoDenkyRepositoryInterface::class);
        $this->assertNotNull($repository);

        $modelsCheck = $repository->get('id', 'asc', 0, 1);
        $this->assertInstanceOf(ThongkeLotoDenky::class, $modelsCheck[0]);

        $modelsCheck = $repository->getByIds($thongkeLotoDenkyIds);
        $this->assertEquals(3, count($modelsCheck));
    }

    public function testFind()
    {
        $models = factory(ThongkeLotoDenky::class, 3)->create();
        $thongkeLotoDenkyIds = $models->pluck('id')->toArray();

        /** @var  \App\Repositories\ThongkeLotoDenkyRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\ThongkeLotoDenkyRepositoryInterface::class);
        $this->assertNotNull($repository);

        $thongkeLotoDenkyCheck = $repository->find($thongkeLotoDenkyIds[0]);
        $this->assertEquals($thongkeLotoDenkyIds[0], $thongkeLotoDenkyCheck->id);
    }

    public function testCreate()
    {
        $thongkeLotoDenkyData = factory(ThongkeLotoDenky::class)->make();

        /** @var  \App\Repositories\ThongkeLotoDenkyRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\ThongkeLotoDenkyRepositoryInterface::class);
        $this->assertNotNull($repository);

        $thongkeLotoDenkyCheck = $repository->create($thongkeLotoDenkyData->toFillableArray());
        $this->assertNotNull($thongkeLotoDenkyCheck);
    }

    public function testUpdate()
    {
        $thongkeLotoDenkyData = factory(ThongkeLotoDenky::class)->create();

        /** @var  \App\Repositories\ThongkeLotoDenkyRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\ThongkeLotoDenkyRepositoryInterface::class);
        $this->assertNotNull($repository);

        $thongkeLotoDenkyCheck = $repository->update($thongkeLotoDenkyData, $thongkeLotoDenkyData->toFillableArray());
        $this->assertNotNull($thongkeLotoDenkyCheck);
    }

    public function testDelete()
    {
        $thongkeLotoDenkyData = factory(ThongkeLotoDenky::class)->create();

        /** @var  \App\Repositories\ThongkeLotoDenkyRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\ThongkeLotoDenkyRepositoryInterface::class);
        $this->assertNotNull($repository);

        $repository->delete($thongkeLotoDenkyData);

        $thongkeLotoDenkyCheck = $repository->find($thongkeLotoDenkyData->id);
        $this->assertNull($thongkeLotoDenkyCheck);
    }

}
