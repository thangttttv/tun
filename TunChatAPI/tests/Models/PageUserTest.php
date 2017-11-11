<?php

namespace Tests\Models;

use App\Models\PageUser;
use Tests\TestCase;

class PageUserTest extends TestCase
{

    protected $useDatabase = true;

    public function testGetInstance()
    {
        /** @var  \App\Models\PageUser $pageUser */
        $pageUser = new PageUser();
        $this->assertNotNull($pageUser);
    }

    public function testStoreNew()
    {
        /** @var  \App\Models\PageUser $pageUser */
        $pageUserModel = new PageUser();

        $pageUserData = factory(PageUser::class)->make();
        foreach( $pageUserData->toFillableArray() as $key => $value ) {
            $pageUserModel->$key = $value;
        }
        $pageUserModel->save();

        $this->assertNotNull(PageUser::find($pageUserModel->id));
    }

}
