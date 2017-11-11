<?php

namespace Tests\Repositories;

use App\Models\KetquaDientoan6x36;
use Tests\TestCase;

class KetquaDientoan6x36RepositoryTest extends TestCase
{
    protected $useDatabase = true;

    public function testGetInstance()
    {
        /** @var  \App\Repositories\KetquaDientoan6x36RepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\KetquaDientoan6x36RepositoryInterface::class);
        $this->assertNotNull($repository);
    }

    public function testGetList()
    {
        $models = factory(KetquaDientoan6x36::class, 3)->create();
        $ketquaDientoan6x36Ids = $models->pluck('id')->toArray();

        /** @var  \App\Repositories\KetquaDientoan6x36RepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\KetquaDientoan6x36RepositoryInterface::class);
        $this->assertNotNull($repository);

        $modelsCheck = $repository->get('id', 'asc', 0, 1);
        $this->assertInstanceOf(KetquaDientoan6x36::class, $modelsCheck[0]);

        $modelsCheck = $repository->getByIds($ketquaDientoan6x36Ids);
        $this->assertEquals(3, count($modelsCheck));
    }

    public function testFind()
    {
        $models = factory(KetquaDientoan6x36::class, 3)->create();
        $ketquaDientoan6x36Ids = $models->pluck('id')->toArray();

        /** @var  \App\Repositories\KetquaDientoan6x36RepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\KetquaDientoan6x36RepositoryInterface::class);
        $this->assertNotNull($repository);

        $ketquaDientoan6x36Check = $repository->find($ketquaDientoan6x36Ids[0]);
        $this->assertEquals($ketquaDientoan6x36Ids[0], $ketquaDientoan6x36Check->id);
    }

    public function testCreate()
    {
        $ketquaDientoan6x36Data = factory(KetquaDientoan6x36::class)->make();

        /** @var  \App\Repositories\KetquaDientoan6x36RepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\KetquaDientoan6x36RepositoryInterface::class);
        $this->assertNotNull($repository);

        $ketquaDientoan6x36Check = $repository->create($ketquaDientoan6x36Data->toFillableArray());
        $this->assertNotNull($ketquaDientoan6x36Check);
    }

    public function testUpdate()
    {
        $ketquaDientoan6x36Data = factory(KetquaDientoan6x36::class)->create();

        /** @var  \App\Repositories\KetquaDientoan6x36RepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\KetquaDientoan6x36RepositoryInterface::class);
        $this->assertNotNull($repository);

        $ketquaDientoan6x36Check = $repository->update($ketquaDientoan6x36Data, $ketquaDientoan6x36Data->toFillableArray());
        $this->assertNotNull($ketquaDientoan6x36Check);
    }

    public function testDelete()
    {
        $ketquaDientoan6x36Data = factory(KetquaDientoan6x36::class)->create();

        /** @var  \App\Repositories\KetquaDientoan6x36RepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\KetquaDientoan6x36RepositoryInterface::class);
        $this->assertNotNull($repository);

        $repository->delete($ketquaDientoan6x36Data);

        $ketquaDientoan6x36Check = $repository->find($ketquaDientoan6x36Data->id);
        $this->assertNull($ketquaDientoan6x36Check);
    }

}
