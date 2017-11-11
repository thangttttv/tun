<?php

namespace Tests\Repositories;

use App\Models\TagCustomer;
use Tests\TestCase;

class TagCustomerRepositoryTest extends TestCase
{
    protected $useDatabase = true;

    public function testGetInstance()
    {
        /** @var  \App\Repositories\TagCustomerRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\TagCustomerRepositoryInterface::class);
        $this->assertNotNull($repository);
    }

    public function testGetList()
    {
        $models = factory(TagCustomer::class, 3)->create();
        $tagCustomerIds = $models->pluck('id')->toArray();

        /** @var  \App\Repositories\TagCustomerRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\TagCustomerRepositoryInterface::class);
        $this->assertNotNull($repository);

        $modelsCheck = $repository->get('id', 'asc', 0, 1);
        $this->assertInstanceOf(TagCustomer::class, $modelsCheck[0]);

        $modelsCheck = $repository->getByIds($tagCustomerIds);
        $this->assertEquals(3, count($modelsCheck));
    }

    public function testFind()
    {
        $models = factory(TagCustomer::class, 3)->create();
        $tagCustomerIds = $models->pluck('id')->toArray();

        /** @var  \App\Repositories\TagCustomerRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\TagCustomerRepositoryInterface::class);
        $this->assertNotNull($repository);

        $tagCustomerCheck = $repository->find($tagCustomerIds[0]);
        $this->assertEquals($tagCustomerIds[0], $tagCustomerCheck->id);
    }

    public function testCreate()
    {
        $tagCustomerData = factory(TagCustomer::class)->make();

        /** @var  \App\Repositories\TagCustomerRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\TagCustomerRepositoryInterface::class);
        $this->assertNotNull($repository);

        $tagCustomerCheck = $repository->create($tagCustomerData->toFillableArray());
        $this->assertNotNull($tagCustomerCheck);
    }

    public function testUpdate()
    {
        $tagCustomerData = factory(TagCustomer::class)->create();

        /** @var  \App\Repositories\TagCustomerRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\TagCustomerRepositoryInterface::class);
        $this->assertNotNull($repository);

        $tagCustomerCheck = $repository->update($tagCustomerData, $tagCustomerData->toFillableArray());
        $this->assertNotNull($tagCustomerCheck);
    }

    public function testDelete()
    {
        $tagCustomerData = factory(TagCustomer::class)->create();

        /** @var  \App\Repositories\TagCustomerRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\TagCustomerRepositoryInterface::class);
        $this->assertNotNull($repository);

        $repository->delete($tagCustomerData);

        $tagCustomerCheck = $repository->find($tagCustomerData->id);
        $this->assertNull($tagCustomerCheck);
    }

}
