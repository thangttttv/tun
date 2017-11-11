<?php

namespace Tests\Repositories;

use App\Models\ThongkeLotoMientrung;
use Tests\TestCase;

class ThongkeLotoMientrungRepositoryTest extends TestCase
{
    protected $useDatabase = true;

    public function testGetInstance()
    {
        /** @var  \App\Repositories\ThongkeLotoMientrungRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\ThongkeLotoMientrungRepositoryInterface::class);
        $this->assertNotNull($repository);
    }

    public function testGetList()
    {
        $models = factory(ThongkeLotoMientrung::class, 3)->create();
        $thongkeLotoMientrungIds = $models->pluck('id')->toArray();

        /** @var  \App\Repositories\ThongkeLotoMientrungRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\ThongkeLotoMientrungRepositoryInterface::class);
        $this->assertNotNull($repository);

        $modelsCheck = $repository->get('id', 'asc', 0, 1);
        $this->assertInstanceOf(ThongkeLotoMientrung::class, $modelsCheck[0]);

        $modelsCheck = $repository->getByIds($thongkeLotoMientrungIds);
        $this->assertEquals(3, count($modelsCheck));
    }

    public function testFind()
    {
        $models = factory(ThongkeLotoMientrung::class, 3)->create();
        $thongkeLotoMientrungIds = $models->pluck('id')->toArray();

        /** @var  \App\Repositories\ThongkeLotoMientrungRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\ThongkeLotoMientrungRepositoryInterface::class);
        $this->assertNotNull($repository);

        $thongkeLotoMientrungCheck = $repository->find($thongkeLotoMientrungIds[0]);
        $this->assertEquals($thongkeLotoMientrungIds[0], $thongkeLotoMientrungCheck->id);
    }

    public function testCreate()
    {
        $thongkeLotoMientrungData = factory(ThongkeLotoMientrung::class)->make();

        /** @var  \App\Repositories\ThongkeLotoMientrungRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\ThongkeLotoMientrungRepositoryInterface::class);
        $this->assertNotNull($repository);

        $thongkeLotoMientrungCheck = $repository->create($thongkeLotoMientrungData->toFillableArray());
        $this->assertNotNull($thongkeLotoMientrungCheck);
    }

    public function testUpdate()
    {
        $thongkeLotoMientrungData = factory(ThongkeLotoMientrung::class)->create();

        /** @var  \App\Repositories\ThongkeLotoMientrungRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\ThongkeLotoMientrungRepositoryInterface::class);
        $this->assertNotNull($repository);

        $thongkeLotoMientrungCheck = $repository->update($thongkeLotoMientrungData, $thongkeLotoMientrungData->toFillableArray());
        $this->assertNotNull($thongkeLotoMientrungCheck);
    }

    public function testDelete()
    {
        $thongkeLotoMientrungData = factory(ThongkeLotoMientrung::class)->create();

        /** @var  \App\Repositories\ThongkeLotoMientrungRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\ThongkeLotoMientrungRepositoryInterface::class);
        $this->assertNotNull($repository);

        $repository->delete($thongkeLotoMientrungData);

        $thongkeLotoMientrungCheck = $repository->find($thongkeLotoMientrungData->id);
        $this->assertNull($thongkeLotoMientrungCheck);
    }

}
