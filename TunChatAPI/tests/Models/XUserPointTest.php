<?php

namespace Tests\Models;

use App\Models\XUserPoint;
use Tests\TestCase;

class XUserPointTest extends TestCase
{

    protected $useDatabase = true;

    public function testGetInstance()
    {
        /** @var  \App\Models\XUserPoint $xUserPoint */
        $xUserPoint = new XUserPoint();
        $this->assertNotNull($xUserPoint);
    }

    public function testStoreNew()
    {
        /** @var  \App\Models\XUserPoint $xUserPoint */
        $xUserPointModel = new XUserPoint();

        $xUserPointData = factory(XUserPoint::class)->make();
        foreach( $xUserPointData->toFillableArray() as $key => $value ) {
            $xUserPointModel->$key = $value;
        }
        $xUserPointModel->save();

        $this->assertNotNull(XUserPoint::find($xUserPointModel->id));
    }

}
