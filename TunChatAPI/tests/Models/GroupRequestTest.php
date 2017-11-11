<?php

namespace Tests\Models;

use App\Models\GroupRequest;
use Tests\TestCase;

class GroupRequestTest extends TestCase
{

    protected $useDatabase = true;

    public function testGetInstance()
    {
        /** @var  \App\Models\GroupRequest $groupRequest */
        $groupRequest = new GroupRequest();
        $this->assertNotNull($groupRequest);
    }

    public function testStoreNew()
    {
        /** @var  \App\Models\GroupRequest $groupRequest */
        $groupRequestModel = new GroupRequest();

        $groupRequestData = factory(GroupRequest::class)->make();
        foreach( $groupRequestData->toFillableArray() as $key => $value ) {
            $groupRequestModel->$key = $value;
        }
        $groupRequestModel->save();

        $this->assertNotNull(GroupRequest::find($groupRequestModel->id));
    }

}
