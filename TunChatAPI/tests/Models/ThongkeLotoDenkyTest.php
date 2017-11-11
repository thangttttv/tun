<?php

namespace Tests\Models;

use App\Models\ThongkeLotoDenky;
use Tests\TestCase;

class ThongkeLotoDenkyTest extends TestCase
{

    protected $useDatabase = true;

    public function testGetInstance()
    {
        /** @var  \App\Models\ThongkeLotoDenky $thongkeLotoDenky */
        $thongkeLotoDenky = new ThongkeLotoDenky();
        $this->assertNotNull($thongkeLotoDenky);
    }

    public function testStoreNew()
    {
        /** @var  \App\Models\ThongkeLotoDenky $thongkeLotoDenky */
        $thongkeLotoDenkyModel = new ThongkeLotoDenky();

        $thongkeLotoDenkyData = factory(ThongkeLotoDenky::class)->make();
        foreach( $thongkeLotoDenkyData->toFillableArray() as $key => $value ) {
            $thongkeLotoDenkyModel->$key = $value;
        }
        $thongkeLotoDenkyModel->save();

        $this->assertNotNull(ThongkeLotoDenky::find($thongkeLotoDenkyModel->id));
    }

}
