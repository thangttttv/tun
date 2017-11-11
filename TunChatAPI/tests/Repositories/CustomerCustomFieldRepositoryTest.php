<?php

namespace Tests\Repositories;

use App\Models\CustomerCustomField;
use Tests\TestCase;

class CustomerCustomFieldRepositoryTest extends TestCase
{
    protected $useDatabase = true;

    public function testGetInstance()
    {
        /** @var  \App\Repositories\CustomerCustomFieldRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\CustomerCustomFieldRepositoryInterface::class);
        $this->assertNotNull($repository);
    }

    public function testGetList()
    {
        $models = factory(CustomerCustomField::class, 3)->create();
        $customerCustomFieldIds = $models->pluck('id')->toArray();

        /** @var  \App\Repositories\CustomerCustomFieldRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\CustomerCustomFieldRepositoryInterface::class);
        $this->assertNotNull($repository);

        $modelsCheck = $repository->get('id', 'asc', 0, 1);
        $this->assertInstanceOf(CustomerCustomField::class, $modelsCheck[0]);

        $modelsCheck = $repository->getByIds($customerCustomFieldIds);
        $this->assertEquals(3, count($modelsCheck));
    }

    public function testFind()
    {
        $models = factory(CustomerCustomField::class, 3)->create();
        $customerCustomFieldIds = $models->pluck('id')->toArray();

        /** @var  \App\Repositories\CustomerCustomFieldRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\CustomerCustomFieldRepositoryInterface::class);
        $this->assertNotNull($repository);

        $customerCustomFieldCheck = $repository->find($customerCustomFieldIds[0]);
        $this->assertEquals($customerCustomFieldIds[0], $customerCustomFieldCheck->id);
    }

    public function testCreate()
    {
        $customerCustomFieldData = factory(CustomerCustomField::class)->make();

        /** @var  \App\Repositories\CustomerCustomFieldRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\CustomerCustomFieldRepositoryInterface::class);
        $this->assertNotNull($repository);

        $customerCustomFieldCheck = $repository->create($customerCustomFieldData->toFillableArray());
        $this->assertNotNull($customerCustomFieldCheck);
    }

    public function testUpdate()
    {
        $customerCustomFieldData = factory(CustomerCustomField::class)->create();

        /** @var  \App\Repositories\CustomerCustomFieldRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\CustomerCustomFieldRepositoryInterface::class);
        $this->assertNotNull($repository);

        $customerCustomFieldCheck = $repository->update($customerCustomFieldData, $customerCustomFieldData->toFillableArray());
        $this->assertNotNull($customerCustomFieldCheck);
    }

    public function testDelete()
    {
        $customerCustomFieldData = factory(CustomerCustomField::class)->create();

        /** @var  \App\Repositories\CustomerCustomFieldRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\CustomerCustomFieldRepositoryInterface::class);
        $this->assertNotNull($repository);

        $repository->delete($customerCustomFieldData);

        $customerCustomFieldCheck = $repository->find($customerCustomFieldData->id);
        $this->assertNull($customerCustomFieldCheck);
    }

}
