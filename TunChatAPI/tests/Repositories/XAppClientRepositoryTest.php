<?php

namespace Tests\Repositories;

use App\Models\XAppClient;
use Tests\TestCase;

class XAppClientRepositoryTest extends TestCase
{
    protected $useDatabase = true;

    public function testGetInstance()
    {
        /** @var  \App\Repositories\XAppClientRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\XAppClientRepositoryInterface::class);
        $this->assertNotNull($repository);
    }

    public function testGetList()
    {
        $models = factory(XAppClient::class, 3)->create();
        $xAppClientIds = $models->pluck('id')->toArray();

        /** @var  \App\Repositories\XAppClientRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\XAppClientRepositoryInterface::class);
        $this->assertNotNull($repository);

        $modelsCheck = $repository->get('id', 'asc', 0, 1);
        $this->assertInstanceOf(XAppClient::class, $modelsCheck[0]);

        $modelsCheck = $repository->getByIds($xAppClientIds);
        $this->assertEquals(3, count($modelsCheck));
    }

    public function testFind()
    {
        $models = factory(XAppClient::class, 3)->create();
        $xAppClientIds = $models->pluck('id')->toArray();

        /** @var  \App\Repositories\XAppClientRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\XAppClientRepositoryInterface::class);
        $this->assertNotNull($repository);

        $xAppClientCheck = $repository->find($xAppClientIds[0]);
        $this->assertEquals($xAppClientIds[0], $xAppClientCheck->id);
    }

    public function testCreate()
    {
        $xAppClientData = factory(XAppClient::class)->make();

        /** @var  \App\Repositories\XAppClientRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\XAppClientRepositoryInterface::class);
        $this->assertNotNull($repository);

        $xAppClientCheck = $repository->create($xAppClientData->toFillableArray());
        $this->assertNotNull($xAppClientCheck);
    }

    public function testUpdate()
    {
        $xAppClientData = factory(XAppClient::class)->create();

        /** @var  \App\Repositories\XAppClientRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\XAppClientRepositoryInterface::class);
        $this->assertNotNull($repository);

        $xAppClientCheck = $repository->update($xAppClientData, $xAppClientData->toFillableArray());
        $this->assertNotNull($xAppClientCheck);
    }

    public function testDelete()
    {
        $xAppClientData = factory(XAppClient::class)->create();

        /** @var  \App\Repositories\XAppClientRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\XAppClientRepositoryInterface::class);
        $this->assertNotNull($repository);

        $repository->delete($xAppClientData);

        $xAppClientCheck = $repository->find($xAppClientData->id);
        $this->assertNull($xAppClientCheck);
    }

}
