<?php

namespace Tests\Models;

use App\Models\GroupUser;
use Tests\TestCase;

class GroupUserTest extends TestCase
{

    protected $useDatabase = true;

    public function testGetInstance()
    {
        /** @var  \App\Models\GroupUser $groupUser */
        $groupUser = new GroupUser();
        $this->assertNotNull($groupUser);
    }

    public function testStoreNew()
    {
        /** @var  \App\Models\GroupUser $groupUser */
        $groupUserModel = new GroupUser();

        $groupUserData = factory(GroupUser::class)->make();
        foreach( $groupUserData->toFillableArray() as $key => $value ) {
            $groupUserModel->$key = $value;
        }
        $groupUserModel->save();

        $this->assertNotNull(GroupUser::find($groupUserModel->id));
    }

}
