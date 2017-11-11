<?php

namespace Tests\Models;

use App\Models\Account;
use Tests\TestCase;

class AccountTest extends TestCase
{

    protected $useDatabase = true;

    public function testGetInstance()
    {
        /** @var  \App\Models\Account $account */
        $account = new Account();
        $this->assertNotNull($account);
    }

    public function testStoreNew()
    {
        /** @var  \App\Models\Account $account */
        $accountModel = new Account();

        $accountData = factory(Account::class)->make();
        foreach( $accountData->toFillableArray() as $key => $value ) {
            $accountModel->$key = $value;
        }
        $accountModel->save();

        $this->assertNotNull(Account::find($accountModel->id));
    }

}
