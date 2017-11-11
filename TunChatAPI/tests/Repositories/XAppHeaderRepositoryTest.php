<?php

namespace Tests\Repositories;

use App\Models\XAppHeader;
use Tests\TestCase;

class XAppHeaderRepositoryTest extends TestCase
{
    protected $useDatabase = true;

    public function testGetInstance()
    {
        /** @var  \App\Repositories\XAppHeaderRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\XAppHeaderRepositoryInterface::class);
        $this->assertNotNull($repository);
    }

    public function testGetList()
    {
        $models = factory(XAppHeader::class, 3)->create();
        $xAppHeaderIds = $models->pluck('id')->toArray();

        /** @var  \App\Repositories\XAppHeaderRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\XAppHeaderRepositoryInterface::class);
        $this->assertNotNull($repository);

        $modelsCheck = $repository->get('id', 'asc', 0, 1);
        $this->assertInstanceOf(XAppHeader::class, $modelsCheck[0]);

        $modelsCheck = $repository->getByIds($xAppHeaderIds);
        $this->assertEquals(3, count($modelsCheck));
    }

    public function testFind()
    {
        $models = factory(XAppHeader::class, 3)->create();
        $xAppHeaderIds = $models->pluck('id')->toArray();

        /** @var  \App\Repositories\XAppHeaderRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\XAppHeaderRepositoryInterface::class);
        $this->assertNotNull($repository);

        $xAppHeaderCheck = $repository->find($xAppHeaderIds[0]);
        $this->assertEquals($xAppHeaderIds[0], $xAppHeaderCheck->id);
    }

    public function testCreate()
    {
        $xAppHeaderData = factory(XAppHeader::class)->make();

        /** @var  \App\Repositories\XAppHeaderRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\XAppHeaderRepositoryInterface::class);
        $this->assertNotNull($repository);

        $xAppHeaderCheck = $repository->create($xAppHeaderData->toFillableArray());
        $this->assertNotNull($xAppHeaderCheck);
    }

    public function testUpdate()
    {
        $xAppHeaderData = factory(XAppHeader::class)->create();

        /** @var  \App\Repositories\XAppHeaderRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\XAppHeaderRepositoryInterface::class);
        $this->assertNotNull($repository);

        $xAppHeaderCheck = $repository->update($xAppHeaderData, $xAppHeaderData->toFillableArray());
        $this->assertNotNull($xAppHeaderCheck);
    }

    public function testDelete()
    {
        $xAppHeaderData = factory(XAppHeader::class)->create();

        /** @var  \App\Repositories\XAppHeaderRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\XAppHeaderRepositoryInterface::class);
        $this->assertNotNull($repository);

        $repository->delete($xAppHeaderData);

        $xAppHeaderCheck = $repository->find($xAppHeaderData->id);
        $this->assertNull($xAppHeaderCheck);
    }

}
