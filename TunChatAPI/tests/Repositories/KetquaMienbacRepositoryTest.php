<?php

namespace Tests\Repositories;

use App\Models\KetquaMienbac;
use Tests\TestCase;

class KetquaMienbacRepositoryTest extends TestCase
{
    protected $useDatabase = true;

    public function testGetInstance()
    {
        /** @var  \App\Repositories\KetquaMienbacRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\KetquaMienbacRepositoryInterface::class);
        $this->assertNotNull($repository);
    }

    public function testGetList()
    {
        $models = factory(KetquaMienbac::class, 3)->create();
        $ketquaMienbacIds = $models->pluck('id')->toArray();

        /** @var  \App\Repositories\KetquaMienbacRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\KetquaMienbacRepositoryInterface::class);
        $this->assertNotNull($repository);

        $modelsCheck = $repository->get('id', 'asc', 0, 1);
        $this->assertInstanceOf(KetquaMienbac::class, $modelsCheck[0]);

        $modelsCheck = $repository->getByIds($ketquaMienbacIds);
        $this->assertEquals(3, count($modelsCheck));
    }

    public function testFind()
    {
        $models = factory(KetquaMienbac::class, 3)->create();
        $ketquaMienbacIds = $models->pluck('id')->toArray();

        /** @var  \App\Repositories\KetquaMienbacRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\KetquaMienbacRepositoryInterface::class);
        $this->assertNotNull($repository);

        $ketquaMienbacCheck = $repository->find($ketquaMienbacIds[0]);
        $this->assertEquals($ketquaMienbacIds[0], $ketquaMienbacCheck->id);
    }

    public function testCreate()
    {
        $ketquaMienbacData = factory(KetquaMienbac::class)->make();

        /** @var  \App\Repositories\KetquaMienbacRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\KetquaMienbacRepositoryInterface::class);
        $this->assertNotNull($repository);

        $ketquaMienbacCheck = $repository->create($ketquaMienbacData->toFillableArray());
        $this->assertNotNull($ketquaMienbacCheck);
    }

    public function testUpdate()
    {
        $ketquaMienbacData = factory(KetquaMienbac::class)->create();

        /** @var  \App\Repositories\KetquaMienbacRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\KetquaMienbacRepositoryInterface::class);
        $this->assertNotNull($repository);

        $ketquaMienbacCheck = $repository->update($ketquaMienbacData, $ketquaMienbacData->toFillableArray());
        $this->assertNotNull($ketquaMienbacCheck);
    }

    public function testDelete()
    {
        $ketquaMienbacData = factory(KetquaMienbac::class)->create();

        /** @var  \App\Repositories\KetquaMienbacRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\KetquaMienbacRepositoryInterface::class);
        $this->assertNotNull($repository);

        $repository->delete($ketquaMienbacData);

        $ketquaMienbacCheck = $repository->find($ketquaMienbacData->id);
        $this->assertNull($ketquaMienbacCheck);
    }

}
