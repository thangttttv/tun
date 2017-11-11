<?php

namespace Tests\Repositories;

use App\Models\ThongkeLotoMiennam;
use Tests\TestCase;

class ThongkeLotoMiennamRepositoryTest extends TestCase
{
    protected $useDatabase = true;

    public function testGetInstance()
    {
        /** @var  \App\Repositories\ThongkeLotoMiennamRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\ThongkeLotoMiennamRepositoryInterface::class);
        $this->assertNotNull($repository);
    }

    public function testGetList()
    {
        $models = factory(ThongkeLotoMiennam::class, 3)->create();
        $thongkeLotoMiennamIds = $models->pluck('id')->toArray();

        /** @var  \App\Repositories\ThongkeLotoMiennamRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\ThongkeLotoMiennamRepositoryInterface::class);
        $this->assertNotNull($repository);

        $modelsCheck = $repository->get('id', 'asc', 0, 1);
        $this->assertInstanceOf(ThongkeLotoMiennam::class, $modelsCheck[0]);

        $modelsCheck = $repository->getByIds($thongkeLotoMiennamIds);
        $this->assertEquals(3, count($modelsCheck));
    }

    public function testFind()
    {
        $models = factory(ThongkeLotoMiennam::class, 3)->create();
        $thongkeLotoMiennamIds = $models->pluck('id')->toArray();

        /** @var  \App\Repositories\ThongkeLotoMiennamRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\ThongkeLotoMiennamRepositoryInterface::class);
        $this->assertNotNull($repository);

        $thongkeLotoMiennamCheck = $repository->find($thongkeLotoMiennamIds[0]);
        $this->assertEquals($thongkeLotoMiennamIds[0], $thongkeLotoMiennamCheck->id);
    }

    public function testCreate()
    {
        $thongkeLotoMiennamData = factory(ThongkeLotoMiennam::class)->make();

        /** @var  \App\Repositories\ThongkeLotoMiennamRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\ThongkeLotoMiennamRepositoryInterface::class);
        $this->assertNotNull($repository);

        $thongkeLotoMiennamCheck = $repository->create($thongkeLotoMiennamData->toFillableArray());
        $this->assertNotNull($thongkeLotoMiennamCheck);
    }

    public function testUpdate()
    {
        $thongkeLotoMiennamData = factory(ThongkeLotoMiennam::class)->create();

        /** @var  \App\Repositories\ThongkeLotoMiennamRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\ThongkeLotoMiennamRepositoryInterface::class);
        $this->assertNotNull($repository);

        $thongkeLotoMiennamCheck = $repository->update($thongkeLotoMiennamData, $thongkeLotoMiennamData->toFillableArray());
        $this->assertNotNull($thongkeLotoMiennamCheck);
    }

    public function testDelete()
    {
        $thongkeLotoMiennamData = factory(ThongkeLotoMiennam::class)->create();

        /** @var  \App\Repositories\ThongkeLotoMiennamRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\ThongkeLotoMiennamRepositoryInterface::class);
        $this->assertNotNull($repository);

        $repository->delete($thongkeLotoMiennamData);

        $thongkeLotoMiennamCheck = $repository->find($thongkeLotoMiennamData->id);
        $this->assertNull($thongkeLotoMiennamCheck);
    }

}
