<?php

namespace Tests\Models;

use App\Models\ThongkeLotoMiennam;
use Tests\TestCase;

class ThongkeLotoMiennamTest extends TestCase
{

    protected $useDatabase = true;

    public function testGetInstance()
    {
        /** @var  \App\Models\ThongkeLotoMiennam $thongkeLotoMiennam */
        $thongkeLotoMiennam = new ThongkeLotoMiennam();
        $this->assertNotNull($thongkeLotoMiennam);
    }

    public function testStoreNew()
    {
        /** @var  \App\Models\ThongkeLotoMiennam $thongkeLotoMiennam */
        $thongkeLotoMiennamModel = new ThongkeLotoMiennam();

        $thongkeLotoMiennamData = factory(ThongkeLotoMiennam::class)->make();
        foreach( $thongkeLotoMiennamData->toFillableArray() as $key => $value ) {
            $thongkeLotoMiennamModel->$key = $value;
        }
        $thongkeLotoMiennamModel->save();

        $this->assertNotNull(ThongkeLotoMiennam::find($thongkeLotoMiennamModel->id));
    }

}
