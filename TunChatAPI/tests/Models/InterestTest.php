<?php

namespace Tests\Models;

use App\Models\Interest;
use Tests\TestCase;

class InterestTest extends TestCase
{

    protected $useDatabase = true;

    public function testGetInstance()
    {
        /** @var  \App\Models\Interest $interest */
        $interest = new Interest();
        $this->assertNotNull($interest);
    }

    public function testStoreNew()
    {
        /** @var  \App\Models\Interest $interest */
        $interestModel = new Interest();

        $interestData = factory(Interest::class)->make();
        foreach( $interestData->toFillableArray() as $key => $value ) {
            $interestModel->$key = $value;
        }
        $interestModel->save();

        $this->assertNotNull(Interest::find($interestModel->id));
    }

}
