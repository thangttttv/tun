<?php

namespace Tests\Models;

use App\Models\XAppClient;
use Tests\TestCase;

class XAppClientTest extends TestCase
{

    protected $useDatabase = true;

    public function testGetInstance()
    {
        /** @var  \App\Models\XAppClient $xAppClient */
        $xAppClient = new XAppClient();
        $this->assertNotNull($xAppClient);
    }

    public function testStoreNew()
    {
        /** @var  \App\Models\XAppClient $xAppClient */
        $xAppClientModel = new XAppClient();

        $xAppClientData = factory(XAppClient::class)->make();
        foreach( $xAppClientData->toFillableArray() as $key => $value ) {
            $xAppClientModel->$key = $value;
        }
        $xAppClientModel->save();

        $this->assertNotNull(XAppClient::find($xAppClientModel->id));
    }

}
