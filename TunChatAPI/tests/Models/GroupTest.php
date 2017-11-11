<?php

namespace Tests\Models;

use App\Models\Group;
use Tests\TestCase;

class GroupTest extends TestCase
{

    protected $useDatabase = true;

    public function testGetInstance()
    {
        /** @var  \App\Models\Group $group */
        $group = new Group();
        $this->assertNotNull($group);
    }

    public function testStoreNew()
    {
        /** @var  \App\Models\Group $group */
        $groupModel = new Group();

        $groupData = factory(Group::class)->make();
        foreach( $groupData->toFillableArray() as $key => $value ) {
            $groupModel->$key = $value;
        }
        $groupModel->save();

        $this->assertNotNull(Group::find($groupModel->id));
    }

}
