<?php

namespace Tests\Repositories;

use App\Models\KetquaMega645;
use Tests\TestCase;

class KetquaMega645RepositoryTest extends TestCase
{
    protected $useDatabase = true;

    public function testGetInstance()
    {
        /** @var  \App\Repositories\KetquaMega645RepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\KetquaMega645RepositoryInterface::class);
        $this->assertNotNull($repository);
    }

    public function testGetList()
    {
        $models = factory(KetquaMega645::class, 3)->create();
        $ketquaMega645Ids = $models->pluck('id')->toArray();

        /** @var  \App\Repositories\KetquaMega645RepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\KetquaMega645RepositoryInterface::class);
        $this->assertNotNull($repository);

        $modelsCheck = $repository->get('id', 'asc', 0, 1);
        $this->assertInstanceOf(KetquaMega645::class, $modelsCheck[0]);

        $modelsCheck = $repository->getByIds($ketquaMega645Ids);
        $this->assertEquals(3, count($modelsCheck));
    }

    public function testFind()
    {
        $models = factory(KetquaMega645::class, 3)->create();
        $ketquaMega645Ids = $models->pluck('id')->toArray();

        /** @var  \App\Repositories\KetquaMega645RepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\KetquaMega645RepositoryInterface::class);
        $this->assertNotNull($repository);

        $ketquaMega645Check = $repository->find($ketquaMega645Ids[0]);
        $this->assertEquals($ketquaMega645Ids[0], $ketquaMega645Check->id);
    }

    public function testCreate()
    {
        $ketquaMega645Data = factory(KetquaMega645::class)->make();

        /** @var  \App\Repositories\KetquaMega645RepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\KetquaMega645RepositoryInterface::class);
        $this->assertNotNull($repository);

        $ketquaMega645Check = $repository->create($ketquaMega645Data->toFillableArray());
        $this->assertNotNull($ketquaMega645Check);
    }

    public function testUpdate()
    {
        $ketquaMega645Data = factory(KetquaMega645::class)->create();

        /** @var  \App\Repositories\KetquaMega645RepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\KetquaMega645RepositoryInterface::class);
        $this->assertNotNull($repository);

        $ketquaMega645Check = $repository->update($ketquaMega645Data, $ketquaMega645Data->toFillableArray());
        $this->assertNotNull($ketquaMega645Check);
    }

    public function testDelete()
    {
        $ketquaMega645Data = factory(KetquaMega645::class)->create();

        /** @var  \App\Repositories\KetquaMega645RepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\KetquaMega645RepositoryInterface::class);
        $this->assertNotNull($repository);

        $repository->delete($ketquaMega645Data);

        $ketquaMega645Check = $repository->find($ketquaMega645Data->id);
        $this->assertNull($ketquaMega645Check);
    }

}
