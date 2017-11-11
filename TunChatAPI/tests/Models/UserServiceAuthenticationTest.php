<?php

namespace Tests\Models;

use App\Models\UserServiceAuthentication;
use Tests\TestCase;

class UserServiceAuthenticationTest extends TestCase
{

    protected $useDatabase = true;

    public function testGetInstance()
    {
        /** @var  \App\Models\UserServiceAuthentication $userServiceAuthentication */
        $userServiceAuthentication = new UserServiceAuthentication();
        $this->assertNotNull($userServiceAuthentication);
    }

    public function testStoreNew()
    {
        /** @var  \App\Models\UserServiceAuthentication $userServiceAuthentication */
        $userServiceAuthenticationModel = new UserServiceAuthentication();

        $userServiceAuthenticationData = factory(UserServiceAuthentication::class)->make();
        foreach( $userServiceAuthenticationData->toFillableArray() as $key => $value ) {
            $userServiceAuthenticationModel->$key = $value;
        }
        $userServiceAuthenticationModel->save();

        $this->assertNotNull(UserServiceAuthentication::find($userServiceAuthenticationModel->id));
    }

}
