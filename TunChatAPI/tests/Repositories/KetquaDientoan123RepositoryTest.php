<?php

namespace Tests\Repositories;

use App\Models\KetquaDientoan123;
use Tests\TestCase;

class KetquaDientoan123RepositoryTest extends TestCase
{
    protected $useDatabase = true;

    public function testGetInstance()
    {
        /** @var  \App\Repositories\KetquaDientoan123RepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\KetquaDientoan123RepositoryInterface::class);
        $this->assertNotNull($repository);
    }

    public function testGetList()
    {
        $models = factory(KetquaDientoan123::class, 3)->create();
        $ketquaDientoan123Ids = $models->pluck('id')->toArray();

        /** @var  \App\Repositories\KetquaDientoan123RepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\KetquaDientoan123RepositoryInterface::class);
        $this->assertNotNull($repository);

        $modelsCheck = $repository->get('id', 'asc', 0, 1);
        $this->assertInstanceOf(KetquaDientoan123::class, $modelsCheck[0]);

        $modelsCheck = $repository->getByIds($ketquaDientoan123Ids);
        $this->assertEquals(3, count($modelsCheck));
    }

    public function testFind()
    {
        $models = factory(KetquaDientoan123::class, 3)->create();
        $ketquaDientoan123Ids = $models->pluck('id')->toArray();

        /** @var  \App\Repositories\KetquaDientoan123RepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\KetquaDientoan123RepositoryInterface::class);
        $this->assertNotNull($repository);

        $ketquaDientoan123Check = $repository->find($ketquaDientoan123Ids[0]);
        $this->assertEquals($ketquaDientoan123Ids[0], $ketquaDientoan123Check->id);
    }

    public function testCreate()
    {
        $ketquaDientoan123Data = factory(KetquaDientoan123::class)->make();

        /** @var  \App\Repositories\KetquaDientoan123RepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\KetquaDientoan123RepositoryInterface::class);
        $this->assertNotNull($repository);

        $ketquaDientoan123Check = $repository->create($ketquaDientoan123Data->toFillableArray());
        $this->assertNotNull($ketquaDientoan123Check);
    }

    public function testUpdate()
    {
        $ketquaDientoan123Data = factory(KetquaDientoan123::class)->create();

        /** @var  \App\Repositories\KetquaDientoan123RepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\KetquaDientoan123RepositoryInterface::class);
        $this->assertNotNull($repository);

        $ketquaDientoan123Check = $repository->update($ketquaDientoan123Data, $ketquaDientoan123Data->toFillableArray());
        $this->assertNotNull($ketquaDientoan123Check);
    }

    public function testDelete()
    {
        $ketquaDientoan123Data = factory(KetquaDientoan123::class)->create();

        /** @var  \App\Repositories\KetquaDientoan123RepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\KetquaDientoan123RepositoryInterface::class);
        $this->assertNotNull($repository);

        $repository->delete($ketquaDientoan123Data);

        $ketquaDientoan123Check = $repository->find($ketquaDientoan123Data->id);
        $this->assertNull($ketquaDientoan123Check);
    }

}
