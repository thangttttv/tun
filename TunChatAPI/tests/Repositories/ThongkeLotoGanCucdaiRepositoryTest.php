<?php

namespace Tests\Repositories;

use App\Models\ThongkeLotoGanCucdai;
use Tests\TestCase;

class ThongkeLotoGanCucdaiRepositoryTest extends TestCase
{
    protected $useDatabase = true;

    public function testGetInstance()
    {
        /** @var  \App\Repositories\ThongkeLotoGanCucdaiRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\ThongkeLotoGanCucdaiRepositoryInterface::class);
        $this->assertNotNull($repository);
    }

    public function testGetList()
    {
        $models = factory(ThongkeLotoGanCucdai::class, 3)->create();
        $thongkeLotoGanCucdaiIds = $models->pluck('id')->toArray();

        /** @var  \App\Repositories\ThongkeLotoGanCucdaiRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\ThongkeLotoGanCucdaiRepositoryInterface::class);
        $this->assertNotNull($repository);

        $modelsCheck = $repository->get('id', 'asc', 0, 1);
        $this->assertInstanceOf(ThongkeLotoGanCucdai::class, $modelsCheck[0]);

        $modelsCheck = $repository->getByIds($thongkeLotoGanCucdaiIds);
        $this->assertEquals(3, count($modelsCheck));
    }

    public function testFind()
    {
        $models = factory(ThongkeLotoGanCucdai::class, 3)->create();
        $thongkeLotoGanCucdaiIds = $models->pluck('id')->toArray();

        /** @var  \App\Repositories\ThongkeLotoGanCucdaiRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\ThongkeLotoGanCucdaiRepositoryInterface::class);
        $this->assertNotNull($repository);

        $thongkeLotoGanCucdaiCheck = $repository->find($thongkeLotoGanCucdaiIds[0]);
        $this->assertEquals($thongkeLotoGanCucdaiIds[0], $thongkeLotoGanCucdaiCheck->id);
    }

    public function testCreate()
    {
        $thongkeLotoGanCucdaiData = factory(ThongkeLotoGanCucdai::class)->make();

        /** @var  \App\Repositories\ThongkeLotoGanCucdaiRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\ThongkeLotoGanCucdaiRepositoryInterface::class);
        $this->assertNotNull($repository);

        $thongkeLotoGanCucdaiCheck = $repository->create($thongkeLotoGanCucdaiData->toFillableArray());
        $this->assertNotNull($thongkeLotoGanCucdaiCheck);
    }

    public function testUpdate()
    {
        $thongkeLotoGanCucdaiData = factory(ThongkeLotoGanCucdai::class)->create();

        /** @var  \App\Repositories\ThongkeLotoGanCucdaiRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\ThongkeLotoGanCucdaiRepositoryInterface::class);
        $this->assertNotNull($repository);

        $thongkeLotoGanCucdaiCheck = $repository->update($thongkeLotoGanCucdaiData, $thongkeLotoGanCucdaiData->toFillableArray());
        $this->assertNotNull($thongkeLotoGanCucdaiCheck);
    }

    public function testDelete()
    {
        $thongkeLotoGanCucdaiData = factory(ThongkeLotoGanCucdai::class)->create();

        /** @var  \App\Repositories\ThongkeLotoGanCucdaiRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\ThongkeLotoGanCucdaiRepositoryInterface::class);
        $this->assertNotNull($repository);

        $repository->delete($thongkeLotoGanCucdaiData);

        $thongkeLotoGanCucdaiCheck = $repository->find($thongkeLotoGanCucdaiData->id);
        $this->assertNull($thongkeLotoGanCucdaiCheck);
    }

}
