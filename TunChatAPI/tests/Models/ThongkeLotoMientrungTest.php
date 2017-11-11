<?php

namespace Tests\Models;

use App\Models\ThongkeLotoMientrung;
use Tests\TestCase;

class ThongkeLotoMientrungTest extends TestCase
{

    protected $useDatabase = true;

    public function testGetInstance()
    {
        /** @var  \App\Models\ThongkeLotoMientrung $thongkeLotoMientrung */
        $thongkeLotoMientrung = new ThongkeLotoMientrung();
        $this->assertNotNull($thongkeLotoMientrung);
    }

    public function testStoreNew()
    {
        /** @var  \App\Models\ThongkeLotoMientrung $thongkeLotoMientrung */
        $thongkeLotoMientrungModel = new ThongkeLotoMientrung();

        $thongkeLotoMientrungData = factory(ThongkeLotoMientrung::class)->make();
        foreach( $thongkeLotoMientrungData->toFillableArray() as $key => $value ) {
            $thongkeLotoMientrungModel->$key = $value;
        }
        $thongkeLotoMientrungModel->save();

        $this->assertNotNull(ThongkeLotoMientrung::find($thongkeLotoMientrungModel->id));
    }

}
