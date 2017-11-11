<?php

namespace Tests\Repositories;

use App\Models\ThongkeLotoMienbac;
use Tests\TestCase;

class ThongkeLotoMienbacRepositoryTest extends TestCase
{
    protected $useDatabase = true;

    public function testGetInstance()
    {
        /** @var  \App\Repositories\ThongkeLotoMienbacRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\ThongkeLotoMienbacRepositoryInterface::class);
        $this->assertNotNull($repository);
    }

    public function testGetList()
    {
        $models = factory(ThongkeLotoMienbac::class, 3)->create();
        $thongkeLotoMienbacIds = $models->pluck('id')->toArray();

        /** @var  \App\Repositories\ThongkeLotoMienbacRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\ThongkeLotoMienbacRepositoryInterface::class);
        $this->assertNotNull($repository);

        $modelsCheck = $repository->get('id', 'asc', 0, 1);
        $this->assertInstanceOf(ThongkeLotoMienbac::class, $modelsCheck[0]);

        $modelsCheck = $repository->getByIds($thongkeLotoMienbacIds);
        $this->assertEquals(3, count($modelsCheck));
    }

    public function testFind()
    {
        $models = factory(ThongkeLotoMienbac::class, 3)->create();
        $thongkeLotoMienbacIds = $models->pluck('id')->toArray();

        /** @var  \App\Repositories\ThongkeLotoMienbacRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\ThongkeLotoMienbacRepositoryInterface::class);
        $this->assertNotNull($repository);

        $thongkeLotoMienbacCheck = $repository->find($thongkeLotoMienbacIds[0]);
        $this->assertEquals($thongkeLotoMienbacIds[0], $thongkeLotoMienbacCheck->id);
    }

    public function testCreate()
    {
        $thongkeLotoMienbacData = factory(ThongkeLotoMienbac::class)->make();

        /** @var  \App\Repositories\ThongkeLotoMienbacRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\ThongkeLotoMienbacRepositoryInterface::class);
        $this->assertNotNull($repository);

        $thongkeLotoMienbacCheck = $repository->create($thongkeLotoMienbacData->toFillableArray());
        $this->assertNotNull($thongkeLotoMienbacCheck);
    }

    public function testUpdate()
    {
        $thongkeLotoMienbacData = factory(ThongkeLotoMienbac::class)->create();

        /** @var  \App\Repositories\ThongkeLotoMienbacRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\ThongkeLotoMienbacRepositoryInterface::class);
        $this->assertNotNull($repository);

        $thongkeLotoMienbacCheck = $repository->update($thongkeLotoMienbacData, $thongkeLotoMienbacData->toFillableArray());
        $this->assertNotNull($thongkeLotoMienbacCheck);
    }

    public function testDelete()
    {
        $thongkeLotoMienbacData = factory(ThongkeLotoMienbac::class)->create();

        /** @var  \App\Repositories\ThongkeLotoMienbacRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\ThongkeLotoMienbacRepositoryInterface::class);
        $this->assertNotNull($repository);

        $repository->delete($thongkeLotoMienbacData);

        $thongkeLotoMienbacCheck = $repository->find($thongkeLotoMienbacData->id);
        $this->assertNull($thongkeLotoMienbacCheck);
    }

}
