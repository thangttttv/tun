<?php

namespace Tests\Repositories;

use App\Models\GroupInvitation;
use Tests\TestCase;

class GroupInvitationRepositoryTest extends TestCase
{
    protected $useDatabase = true;

    public function testGetInstance()
    {
        /** @var  \App\Repositories\GroupInvitationRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\GroupInvitationRepositoryInterface::class);
        $this->assertNotNull($repository);
    }

    public function testGetList()
    {
        $models = factory(GroupInvitation::class, 3)->create();
        $groupInvitationIds = $models->pluck('id')->toArray();

        /** @var  \App\Repositories\GroupInvitationRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\GroupInvitationRepositoryInterface::class);
        $this->assertNotNull($repository);

        $modelsCheck = $repository->get('id', 'asc', 0, 1);
        $this->assertInstanceOf(GroupInvitation::class, $modelsCheck[0]);

        $modelsCheck = $repository->getByIds($groupInvitationIds);
        $this->assertEquals(3, count($modelsCheck));
    }

    public function testFind()
    {
        $models = factory(GroupInvitation::class, 3)->create();
        $groupInvitationIds = $models->pluck('id')->toArray();

        /** @var  \App\Repositories\GroupInvitationRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\GroupInvitationRepositoryInterface::class);
        $this->assertNotNull($repository);

        $groupInvitationCheck = $repository->find($groupInvitationIds[0]);
        $this->assertEquals($groupInvitationIds[0], $groupInvitationCheck->id);
    }

    public function testCreate()
    {
        $groupInvitationData = factory(GroupInvitation::class)->make();

        /** @var  \App\Repositories\GroupInvitationRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\GroupInvitationRepositoryInterface::class);
        $this->assertNotNull($repository);

        $groupInvitationCheck = $repository->create($groupInvitationData->toFillableArray());
        $this->assertNotNull($groupInvitationCheck);
    }

    public function testUpdate()
    {
        $groupInvitationData = factory(GroupInvitation::class)->create();

        /** @var  \App\Repositories\GroupInvitationRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\GroupInvitationRepositoryInterface::class);
        $this->assertNotNull($repository);

        $groupInvitationCheck = $repository->update($groupInvitationData, $groupInvitationData->toFillableArray());
        $this->assertNotNull($groupInvitationCheck);
    }

    public function testDelete()
    {
        $groupInvitationData = factory(GroupInvitation::class)->create();

        /** @var  \App\Repositories\GroupInvitationRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\GroupInvitationRepositoryInterface::class);
        $this->assertNotNull($repository);

        $repository->delete($groupInvitationData);

        $groupInvitationCheck = $repository->find($groupInvitationData->id);
        $this->assertNull($groupInvitationCheck);
    }

}
