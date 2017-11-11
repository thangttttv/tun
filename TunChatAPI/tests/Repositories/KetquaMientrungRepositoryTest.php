<?php

namespace Tests\Repositories;

use App\Models\KetquaMientrung;
use Tests\TestCase;

class KetquaMientrungRepositoryTest extends TestCase
{
    protected $useDatabase = true;

    public function testGetInstance()
    {
        /** @var  \App\Repositories\KetquaMientrungRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\KetquaMientrungRepositoryInterface::class);
        $this->assertNotNull($repository);
    }

    public function testGetList()
    {
        $models = factory(KetquaMientrung::class, 3)->create();
        $ketquaMientrungIds = $models->pluck('id')->toArray();

        /** @var  \App\Repositories\KetquaMientrungRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\KetquaMientrungRepositoryInterface::class);
        $this->assertNotNull($repository);

        $modelsCheck = $repository->get('id', 'asc', 0, 1);
        $this->assertInstanceOf(KetquaMientrung::class, $modelsCheck[0]);

        $modelsCheck = $repository->getByIds($ketquaMientrungIds);
        $this->assertEquals(3, count($modelsCheck));
    }

    public function testFind()
    {
        $models = factory(KetquaMientrung::class, 3)->create();
        $ketquaMientrungIds = $models->pluck('id')->toArray();

        /** @var  \App\Repositories\KetquaMientrungRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\KetquaMientrungRepositoryInterface::class);
        $this->assertNotNull($repository);

        $ketquaMientrungCheck = $repository->find($ketquaMientrungIds[0]);
        $this->assertEquals($ketquaMientrungIds[0], $ketquaMientrungCheck->id);
    }

    public function testCreate()
    {
        $ketquaMientrungData = factory(KetquaMientrung::class)->make();

        /** @var  \App\Repositories\KetquaMientrungRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\KetquaMientrungRepositoryInterface::class);
        $this->assertNotNull($repository);

        $ketquaMientrungCheck = $repository->create($ketquaMientrungData->toFillableArray());
        $this->assertNotNull($ketquaMientrungCheck);
    }

    public function testUpdate()
    {
        $ketquaMientrungData = factory(KetquaMientrung::class)->create();

        /** @var  \App\Repositories\KetquaMientrungRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\KetquaMientrungRepositoryInterface::class);
        $this->assertNotNull($repository);

        $ketquaMientrungCheck = $repository->update($ketquaMientrungData, $ketquaMientrungData->toFillableArray());
        $this->assertNotNull($ketquaMientrungCheck);
    }

    public function testDelete()
    {
        $ketquaMientrungData = factory(KetquaMientrung::class)->create();

        /** @var  \App\Repositories\KetquaMientrungRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\KetquaMientrungRepositoryInterface::class);
        $this->assertNotNull($repository);

        $repository->delete($ketquaMientrungData);

        $ketquaMientrungCheck = $repository->find($ketquaMientrungData->id);
        $this->assertNull($ketquaMientrungCheck);
    }

}
