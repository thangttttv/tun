<?php

namespace Tests\Models;

use App\Models\feed;
use Tests\TestCase;

class feedTest extends TestCase
{

    protected $useDatabase = true;

    public function testGetInstance()
    {
        /** @var  \App\Models\feed $feed */
        $feed = new feed();
        $this->assertNotNull($feed);
    }

    public function testStoreNew()
    {
        /** @var  \App\Models\feed $feed */
        $feedModel = new feed();

        $feedData = factory(feed::class)->make();
        foreach( $feedData->toFillableArray() as $key => $value ) {
            $feedModel->$key = $value;
        }
        $feedModel->save();

        $this->assertNotNull(feed::find($feedModel->id));
    }

}
