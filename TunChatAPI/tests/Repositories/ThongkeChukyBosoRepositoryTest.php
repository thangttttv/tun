<?php

namespace Tests\Repositories;

use App\Models\ThongkeChukyBoso;
use Tests\TestCase;

class ThongkeChukyBosoRepositoryTest extends TestCase
{
    protected $useDatabase = true;

    public function testGetInstance()
    {
        /** @var  \App\Repositories\ThongkeChukyBosoRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\ThongkeChukyBosoRepositoryInterface::class);
        $this->assertNotNull($repository);
    }

    public function testGetList()
    {
        $models = factory(ThongkeChukyBoso::class, 3)->create();
        $thongkeChukyBosoIds = $models->pluck('id')->toArray();

        /** @var  \App\Repositories\ThongkeChukyBosoRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\ThongkeChukyBosoRepositoryInterface::class);
        $this->assertNotNull($repository);

        $modelsCheck = $repository->get('id', 'asc', 0, 1);
        $this->assertInstanceOf(ThongkeChukyBoso::class, $modelsCheck[0]);

        $modelsCheck = $repository->getByIds($thongkeChukyBosoIds);
        $this->assertEquals(3, count($modelsCheck));
    }

    public function testFind()
    {
        $models = factory(ThongkeChukyBoso::class, 3)->create();
        $thongkeChukyBosoIds = $models->pluck('id')->toArray();

        /** @var  \App\Repositories\ThongkeChukyBosoRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\ThongkeChukyBosoRepositoryInterface::class);
        $this->assertNotNull($repository);

        $thongkeChukyBosoCheck = $repository->find($thongkeChukyBosoIds[0]);
        $this->assertEquals($thongkeChukyBosoIds[0], $thongkeChukyBosoCheck->id);
    }

    public function testCreate()
    {
        $thongkeChukyBosoData = factory(ThongkeChukyBoso::class)->make();

        /** @var  \App\Repositories\ThongkeChukyBosoRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\ThongkeChukyBosoRepositoryInterface::class);
        $this->assertNotNull($repository);

        $thongkeChukyBosoCheck = $repository->create($thongkeChukyBosoData->toFillableArray());
        $this->assertNotNull($thongkeChukyBosoCheck);
    }

    public function testUpdate()
    {
        $thongkeChukyBosoData = factory(ThongkeChukyBoso::class)->create();

        /** @var  \App\Repositories\ThongkeChukyBosoRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\ThongkeChukyBosoRepositoryInterface::class);
        $this->assertNotNull($repository);

        $thongkeChukyBosoCheck = $repository->update($thongkeChukyBosoData, $thongkeChukyBosoData->toFillableArray());
        $this->assertNotNull($thongkeChukyBosoCheck);
    }

    public function testDelete()
    {
        $thongkeChukyBosoData = factory(ThongkeChukyBoso::class)->create();

        /** @var  \App\Repositories\ThongkeChukyBosoRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\ThongkeChukyBosoRepositoryInterface::class);
        $this->assertNotNull($repository);

        $repository->delete($thongkeChukyBosoData);

        $thongkeChukyBosoCheck = $repository->find($thongkeChukyBosoData->id);
        $this->assertNull($thongkeChukyBosoCheck);
    }

}
