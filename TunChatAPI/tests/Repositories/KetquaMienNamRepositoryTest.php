<?php

namespace Tests\Repositories;

use App\Models\KetquaMienNam;
use Tests\TestCase;

class KetquaMienNamRepositoryTest extends TestCase
{
    protected $useDatabase = true;

    public function testGetInstance()
    {
        /** @var  \App\Repositories\KetquaMienNamRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\KetquaMienNamRepositoryInterface::class);
        $this->assertNotNull($repository);
    }

    public function testGetList()
    {
        $models = factory(KetquaMienNam::class, 3)->create();
        $ketquaMienNamIds = $models->pluck('id')->toArray();

        /** @var  \App\Repositories\KetquaMienNamRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\KetquaMienNamRepositoryInterface::class);
        $this->assertNotNull($repository);

        $modelsCheck = $repository->get('id', 'asc', 0, 1);
        $this->assertInstanceOf(KetquaMienNam::class, $modelsCheck[0]);

        $modelsCheck = $repository->getByIds($ketquaMienNamIds);
        $this->assertEquals(3, count($modelsCheck));
    }

    public function testFind()
    {
        $models = factory(KetquaMienNam::class, 3)->create();
        $ketquaMienNamIds = $models->pluck('id')->toArray();

        /** @var  \App\Repositories\KetquaMienNamRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\KetquaMienNamRepositoryInterface::class);
        $this->assertNotNull($repository);

        $ketquaMienNamCheck = $repository->find($ketquaMienNamIds[0]);
        $this->assertEquals($ketquaMienNamIds[0], $ketquaMienNamCheck->id);
    }

    public function testCreate()
    {
        $ketquaMienNamData = factory(KetquaMienNam::class)->make();

        /** @var  \App\Repositories\KetquaMienNamRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\KetquaMienNamRepositoryInterface::class);
        $this->assertNotNull($repository);

        $ketquaMienNamCheck = $repository->create($ketquaMienNamData->toFillableArray());
        $this->assertNotNull($ketquaMienNamCheck);
    }

    public function testUpdate()
    {
        $ketquaMienNamData = factory(KetquaMienNam::class)->create();

        /** @var  \App\Repositories\KetquaMienNamRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\KetquaMienNamRepositoryInterface::class);
        $this->assertNotNull($repository);

        $ketquaMienNamCheck = $repository->update($ketquaMienNamData, $ketquaMienNamData->toFillableArray());
        $this->assertNotNull($ketquaMienNamCheck);
    }

    public function testDelete()
    {
        $ketquaMienNamData = factory(KetquaMienNam::class)->create();

        /** @var  \App\Repositories\KetquaMienNamRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\KetquaMienNamRepositoryInterface::class);
        $this->assertNotNull($repository);

        $repository->delete($ketquaMienNamData);

        $ketquaMienNamCheck = $repository->find($ketquaMienNamData->id);
        $this->assertNull($ketquaMienNamCheck);
    }

}
