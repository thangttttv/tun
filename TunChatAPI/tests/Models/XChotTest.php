<?php

namespace Tests\Models;

use App\Models\XChot;
use Tests\TestCase;

class XChotTest extends TestCase
{

    protected $useDatabase = true;

    public function testGetInstance()
    {
        /** @var  \App\Models\XChot $xChot */
        $xChot = new XChot();
        $this->assertNotNull($xChot);
    }

    public function testStoreNew()
    {
        /** @var  \App\Models\XChot $xChot */
        $xChotModel = new XChot();

        $xChotData = factory(XChot::class)->make();
        foreach( $xChotData->toFillableArray() as $key => $value ) {
            $xChotModel->$key = $value;
        }
        $xChotModel->save();

        $this->assertNotNull(XChot::find($xChotModel->id));
    }

}
