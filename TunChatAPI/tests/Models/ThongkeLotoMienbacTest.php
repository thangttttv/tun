<?php

namespace Tests\Models;

use App\Models\ThongkeLotoMienbac;
use Tests\TestCase;

class ThongkeLotoMienbacTest extends TestCase
{

    protected $useDatabase = true;

    public function testGetInstance()
    {
        /** @var  \App\Models\ThongkeLotoMienbac $thongkeLotoMienbac */
        $thongkeLotoMienbac = new ThongkeLotoMienbac();
        $this->assertNotNull($thongkeLotoMienbac);
    }

    public function testStoreNew()
    {
        /** @var  \App\Models\ThongkeLotoMienbac $thongkeLotoMienbac */
        $thongkeLotoMienbacModel = new ThongkeLotoMienbac();

        $thongkeLotoMienbacData = factory(ThongkeLotoMienbac::class)->make();
        foreach( $thongkeLotoMienbacData->toFillableArray() as $key => $value ) {
            $thongkeLotoMienbacModel->$key = $value;
        }
        $thongkeLotoMienbacModel->save();

        $this->assertNotNull(ThongkeLotoMienbac::find($thongkeLotoMienbacModel->id));
    }

}
