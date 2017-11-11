<?php

namespace Tests\Models;

use App\Models\XAppHeader;
use Tests\TestCase;

class XAppHeaderTest extends TestCase
{

    protected $useDatabase = true;

    public function testGetInstance()
    {
        /** @var  \App\Models\XAppHeader $xAppHeader */
        $xAppHeader = new XAppHeader();
        $this->assertNotNull($xAppHeader);
    }

    public function testStoreNew()
    {
        /** @var  \App\Models\XAppHeader $xAppHeader */
        $xAppHeaderModel = new XAppHeader();

        $xAppHeaderData = factory(XAppHeader::class)->make();
        foreach( $xAppHeaderData->toFillableArray() as $key => $value ) {
            $xAppHeaderModel->$key = $value;
        }
        $xAppHeaderModel->save();

        $this->assertNotNull(XAppHeader::find($xAppHeaderModel->id));
    }

}
