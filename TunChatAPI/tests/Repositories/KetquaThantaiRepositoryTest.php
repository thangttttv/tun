<?php

namespace Tests\Repositories;

use App\Models\KetquaThantai;
use Tests\TestCase;

class KetquaThantaiRepositoryTest extends TestCase
{
    protected $useDatabase = true;

    public function testGetInstance()
    {
        /** @var  \App\Repositories\KetquaThantaiRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\KetquaThantaiRepositoryInterface::class);
        $this->assertNotNull($repository);
    }

    public function testGetList()
    {
        $models = factory(KetquaThantai::class, 3)->create();
        $ketquaThantaiIds = $models->pluck('id')->toArray();

        /** @var  \App\Repositories\KetquaThantaiRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\KetquaThantaiRepositoryInterface::class);
        $this->assertNotNull($repository);

        $modelsCheck = $repository->get('id', 'asc', 0, 1);
        $this->assertInstanceOf(KetquaThantai::class, $modelsCheck[0]);

        $modelsCheck = $repository->getByIds($ketquaThantaiIds);
        $this->assertEquals(3, count($modelsCheck));
    }

    public function testFind()
    {
        $models = factory(KetquaThantai::class, 3)->create();
        $ketquaThantaiIds = $models->pluck('id')->toArray();

        /** @var  \App\Repositories\KetquaThantaiRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\KetquaThantaiRepositoryInterface::class);
        $this->assertNotNull($repository);

        $ketquaThantaiCheck = $repository->find($ketquaThantaiIds[0]);
        $this->assertEquals($ketquaThantaiIds[0], $ketquaThantaiCheck->id);
    }

    public function testCreate()
    {
        $ketquaThantaiData = factory(KetquaThantai::class)->make();

        /** @var  \App\Repositories\KetquaThantaiRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\KetquaThantaiRepositoryInterface::class);
        $this->assertNotNull($repository);

        $ketquaThantaiCheck = $repository->create($ketquaThantaiData->toFillableArray());
        $this->assertNotNull($ketquaThantaiCheck);
    }

    public function testUpdate()
    {
        $ketquaThantaiData = factory(KetquaThantai::class)->create();

        /** @var  \App\Repositories\KetquaThantaiRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\KetquaThantaiRepositoryInterface::class);
        $this->assertNotNull($repository);

        $ketquaThantaiCheck = $repository->update($ketquaThantaiData, $ketquaThantaiData->toFillableArray());
        $this->assertNotNull($ketquaThantaiCheck);
    }

    public function testDelete()
    {
        $ketquaThantaiData = factory(KetquaThantai::class)->create();

        /** @var  \App\Repositories\KetquaThantaiRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\KetquaThantaiRepositoryInterface::class);
        $this->assertNotNull($repository);

        $repository->delete($ketquaThantaiData);

        $ketquaThantaiCheck = $repository->find($ketquaThantaiData->id);
        $this->assertNull($ketquaThantaiCheck);
    }

}
