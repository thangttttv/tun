<?php

namespace Tests\Repositories;

use App\Models\KetquaMax4d;
use Tests\TestCase;

class KetquaMax4dRepositoryTest extends TestCase
{
    protected $useDatabase = true;

    public function testGetInstance()
    {
        /** @var  \App\Repositories\KetquaMax4dRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\KetquaMax4dRepositoryInterface::class);
        $this->assertNotNull($repository);
    }

    public function testGetList()
    {
        $models = factory(KetquaMax4d::class, 3)->create();
        $ketquaMax4dIds = $models->pluck('id')->toArray();

        /** @var  \App\Repositories\KetquaMax4dRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\KetquaMax4dRepositoryInterface::class);
        $this->assertNotNull($repository);

        $modelsCheck = $repository->get('id', 'asc', 0, 1);
        $this->assertInstanceOf(KetquaMax4d::class, $modelsCheck[0]);

        $modelsCheck = $repository->getByIds($ketquaMax4dIds);
        $this->assertEquals(3, count($modelsCheck));
    }

    public function testFind()
    {
        $models = factory(KetquaMax4d::class, 3)->create();
        $ketquaMax4dIds = $models->pluck('id')->toArray();

        /** @var  \App\Repositories\KetquaMax4dRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\KetquaMax4dRepositoryInterface::class);
        $this->assertNotNull($repository);

        $ketquaMax4dCheck = $repository->find($ketquaMax4dIds[0]);
        $this->assertEquals($ketquaMax4dIds[0], $ketquaMax4dCheck->id);
    }

    public function testCreate()
    {
        $ketquaMax4dData = factory(KetquaMax4d::class)->make();

        /** @var  \App\Repositories\KetquaMax4dRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\KetquaMax4dRepositoryInterface::class);
        $this->assertNotNull($repository);

        $ketquaMax4dCheck = $repository->create($ketquaMax4dData->toFillableArray());
        $this->assertNotNull($ketquaMax4dCheck);
    }

    public function testUpdate()
    {
        $ketquaMax4dData = factory(KetquaMax4d::class)->create();

        /** @var  \App\Repositories\KetquaMax4dRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\KetquaMax4dRepositoryInterface::class);
        $this->assertNotNull($repository);

        $ketquaMax4dCheck = $repository->update($ketquaMax4dData, $ketquaMax4dData->toFillableArray());
        $this->assertNotNull($ketquaMax4dCheck);
    }

    public function testDelete()
    {
        $ketquaMax4dData = factory(KetquaMax4d::class)->create();

        /** @var  \App\Repositories\KetquaMax4dRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\KetquaMax4dRepositoryInterface::class);
        $this->assertNotNull($repository);

        $repository->delete($ketquaMax4dData);

        $ketquaMax4dCheck = $repository->find($ketquaMax4dData->id);
        $this->assertNull($ketquaMax4dCheck);
    }

}
