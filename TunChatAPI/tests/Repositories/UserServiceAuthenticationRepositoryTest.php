<?php

namespace Tests\Repositories;

use App\Models\UserServiceAuthentication;
use Tests\TestCase;

class UserServiceAuthenticationRepositoryTest extends TestCase
{
    protected $useDatabase = true;

    public function testGetInstance()
    {
        /** @var  \App\Repositories\UserServiceAuthenticationRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\UserServiceAuthenticationRepositoryInterface::class);
        $this->assertNotNull($repository);
    }

    public function testGetList()
    {
        $models = factory(UserServiceAuthentication::class, 3)->create();
        $userServiceAuthenticationIds = $models->pluck('id')->toArray();

        /** @var  \App\Repositories\UserServiceAuthenticationRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\UserServiceAuthenticationRepositoryInterface::class);
        $this->assertNotNull($repository);

        $modelsCheck = $repository->get('id', 'asc', 0, 1);
        $this->assertInstanceOf(UserServiceAuthentication::class, $modelsCheck[0]);

        $modelsCheck = $repository->getByIds($userServiceAuthenticationIds);
        $this->assertEquals(3, count($modelsCheck));
    }

    public function testFind()
    {
        $models = factory(UserServiceAuthentication::class, 3)->create();
        $userServiceAuthenticationIds = $models->pluck('id')->toArray();

        /** @var  \App\Repositories\UserServiceAuthenticationRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\UserServiceAuthenticationRepositoryInterface::class);
        $this->assertNotNull($repository);

        $userServiceAuthenticationCheck = $repository->find($userServiceAuthenticationIds[0]);
        $this->assertEquals($userServiceAuthenticationIds[0], $userServiceAuthenticationCheck->id);
    }

    public function testCreate()
    {
        $userServiceAuthenticationData = factory(UserServiceAuthentication::class)->make();

        /** @var  \App\Repositories\UserServiceAuthenticationRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\UserServiceAuthenticationRepositoryInterface::class);
        $this->assertNotNull($repository);

        $userServiceAuthenticationCheck = $repository->create($userServiceAuthenticationData->toFillableArray());
        $this->assertNotNull($userServiceAuthenticationCheck);
    }

    public function testUpdate()
    {
        $userServiceAuthenticationData = factory(UserServiceAuthentication::class)->create();

        /** @var  \App\Repositories\UserServiceAuthenticationRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\UserServiceAuthenticationRepositoryInterface::class);
        $this->assertNotNull($repository);

        $userServiceAuthenticationCheck = $repository->update($userServiceAuthenticationData, $userServiceAuthenticationData->toFillableArray());
        $this->assertNotNull($userServiceAuthenticationCheck);
    }

    public function testDelete()
    {
        $userServiceAuthenticationData = factory(UserServiceAuthentication::class)->create();

        /** @var  \App\Repositories\UserServiceAuthenticationRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\UserServiceAuthenticationRepositoryInterface::class);
        $this->assertNotNull($repository);

        $repository->delete($userServiceAuthenticationData);

        $userServiceAuthenticationCheck = $repository->find($userServiceAuthenticationData->id);
        $this->assertNull($userServiceAuthenticationCheck);
    }

}
