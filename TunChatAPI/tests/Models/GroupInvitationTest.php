<?php

namespace Tests\Models;

use App\Models\GroupInvitation;
use Tests\TestCase;

class GroupInvitationTest extends TestCase
{

    protected $useDatabase = true;

    public function testGetInstance()
    {
        /** @var  \App\Models\GroupInvitation $groupInvitation */
        $groupInvitation = new GroupInvitation();
        $this->assertNotNull($groupInvitation);
    }

    public function testStoreNew()
    {
        /** @var  \App\Models\GroupInvitation $groupInvitation */
        $groupInvitationModel = new GroupInvitation();

        $groupInvitationData = factory(GroupInvitation::class)->make();
        foreach( $groupInvitationData->toFillableArray() as $key => $value ) {
            $groupInvitationModel->$key = $value;
        }
        $groupInvitationModel->save();

        $this->assertNotNull(GroupInvitation::find($groupInvitationModel->id));
    }

}
