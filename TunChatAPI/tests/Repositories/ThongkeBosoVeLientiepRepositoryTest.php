<?php

namespace Tests\Repositories;

use App\Models\ThongkeBosoVeLientiep;
use Tests\TestCase;

class ThongkeBosoVeLientiepRepositoryTest extends TestCase
{
    protected $useDatabase = true;

    public function testGetInstance()
    {
        /** @var  \App\Repositories\ThongkeBosoVeLientiepRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\ThongkeBosoVeLientiepRepositoryInterface::class);
        $this->assertNotNull($repository);
    }

    public function testGetList()
    {
        $models = factory(ThongkeBosoVeLientiep::class, 3)->create();
        $thongkeBosoVeLientiepIds = $models->pluck('id')->toArray();

        /** @var  \App\Repositories\ThongkeBosoVeLientiepRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\ThongkeBosoVeLientiepRepositoryInterface::class);
        $this->assertNotNull($repository);

        $modelsCheck = $repository->get('id', 'asc', 0, 1);
        $this->assertInstanceOf(ThongkeBosoVeLientiep::class, $modelsCheck[0]);

        $modelsCheck = $repository->getByIds($thongkeBosoVeLientiepIds);
        $this->assertEquals(3, count($modelsCheck));
    }

    public function testFind()
    {
        $models = factory(ThongkeBosoVeLientiep::class, 3)->create();
        $thongkeBosoVeLientiepIds = $models->pluck('id')->toArray();

        /** @var  \App\Repositories\ThongkeBosoVeLientiepRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\ThongkeBosoVeLientiepRepositoryInterface::class);
        $this->assertNotNull($repository);

        $thongkeBosoVeLientiepCheck = $repository->find($thongkeBosoVeLientiepIds[0]);
        $this->assertEquals($thongkeBosoVeLientiepIds[0], $thongkeBosoVeLientiepCheck->id);
    }

    public function testCreate()
    {
        $thongkeBosoVeLientiepData = factory(ThongkeBosoVeLientiep::class)->make();

        /** @var  \App\Repositories\ThongkeBosoVeLientiepRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\ThongkeBosoVeLientiepRepositoryInterface::class);
        $this->assertNotNull($repository);

        $thongkeBosoVeLientiepCheck = $repository->create($thongkeBosoVeLientiepData->toFillableArray());
        $this->assertNotNull($thongkeBosoVeLientiepCheck);
    }

    public function testUpdate()
    {
        $thongkeBosoVeLientiepData = factory(ThongkeBosoVeLientiep::class)->create();

        /** @var  \App\Repositories\ThongkeBosoVeLientiepRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\ThongkeBosoVeLientiepRepositoryInterface::class);
        $this->assertNotNull($repository);

        $thongkeBosoVeLientiepCheck = $repository->update($thongkeBosoVeLientiepData, $thongkeBosoVeLientiepData->toFillableArray());
        $this->assertNotNull($thongkeBosoVeLientiepCheck);
    }

    public function testDelete()
    {
        $thongkeBosoVeLientiepData = factory(ThongkeBosoVeLientiep::class)->create();

        /** @var  \App\Repositories\ThongkeBosoVeLientiepRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\ThongkeBosoVeLientiepRepositoryInterface::class);
        $this->assertNotNull($repository);

        $repository->delete($thongkeBosoVeLientiepData);

        $thongkeBosoVeLientiepCheck = $repository->find($thongkeBosoVeLientiepData->id);
        $this->assertNull($thongkeBosoVeLientiepCheck);
    }

}
