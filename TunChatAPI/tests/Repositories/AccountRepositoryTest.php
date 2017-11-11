<?php

namespace Tests\Repositories;

use App\Models\Account;
use Tests\TestCase;

class AccountRepositoryTest extends TestCase
{
    protected $useDatabase = true;

    public function testGetInstance()
    {
        /** @var  \App\Repositories\AccountRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\AccountRepositoryInterface::class);
        $this->assertNotNull($repository);
    }

    public function testGetList()
    {
        $models = factory(Account::class, 3)->create();
        $accountIds = $models->pluck('id')->toArray();

        /** @var  \App\Repositories\AccountRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\AccountRepositoryInterface::class);
        $this->assertNotNull($repository);

        $modelsCheck = $repository->get('id', 'asc', 0, 1);
        $this->assertInstanceOf(Account::class, $modelsCheck[0]);

        $modelsCheck = $repository->getByIds($accountIds);
        $this->assertEquals(3, count($modelsCheck));
    }

    public function testFind()
    {
        $models = factory(Account::class, 3)->create();
        $accountIds = $models->pluck('id')->toArray();

        /** @var  \App\Repositories\AccountRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\AccountRepositoryInterface::class);
        $this->assertNotNull($repository);

        $accountCheck = $repository->find($accountIds[0]);
        $this->assertEquals($accountIds[0], $accountCheck->id);
    }

    public function testCreate()
    {
        $accountData = factory(Account::class)->make();

        /** @var  \App\Repositories\AccountRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\AccountRepositoryInterface::class);
        $this->assertNotNull($repository);

        $accountCheck = $repository->create($accountData->toFillableArray());
        $this->assertNotNull($accountCheck);
    }

    public function testUpdate()
    {
        $accountData = factory(Account::class)->create();

        /** @var  \App\Repositories\AccountRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\AccountRepositoryInterface::class);
        $this->assertNotNull($repository);

        $accountCheck = $repository->update($accountData, $accountData->toFillableArray());
        $this->assertNotNull($accountCheck);
    }

    public function testDelete()
    {
        $accountData = factory(Account::class)->create();

        /** @var  \App\Repositories\AccountRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\AccountRepositoryInterface::class);
        $this->assertNotNull($repository);

        $repository->delete($accountData);

        $accountCheck = $repository->find($accountData->id);
        $this->assertNull($accountCheck);
    }

}
