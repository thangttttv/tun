<?php

namespace Tests\Models;

use App\Models\ThongkeChukyBoso;
use Tests\TestCase;

class ThongkeChukyBosoTest extends TestCase
{

    protected $useDatabase = true;

    public function testGetInstance()
    {
        /** @var  \App\Models\ThongkeChukyBoso $thongkeChukyBoso */
        $thongkeChukyBoso = new ThongkeChukyBoso();
        $this->assertNotNull($thongkeChukyBoso);
    }

    public function testStoreNew()
    {
        /** @var  \App\Models\ThongkeChukyBoso $thongkeChukyBoso */
        $thongkeChukyBosoModel = new ThongkeChukyBoso();

        $thongkeChukyBosoData = factory(ThongkeChukyBoso::class)->make();
        foreach( $thongkeChukyBosoData->toFillableArray() as $key => $value ) {
            $thongkeChukyBosoModel->$key = $value;
        }
        $thongkeChukyBosoModel->save();

        $this->assertNotNull(ThongkeChukyBoso::find($thongkeChukyBosoModel->id));
    }

}
