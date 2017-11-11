<?php

namespace Tests\Models;

use App\Models\KetquaThantai;
use Tests\TestCase;

class KetquaThantaiTest extends TestCase
{

    protected $useDatabase = true;

    public function testGetInstance()
    {
        /** @var  \App\Models\KetquaThantai $ketquaThantai */
        $ketquaThantai = new KetquaThantai();
        $this->assertNotNull($ketquaThantai);
    }

    public function testStoreNew()
    {
        /** @var  \App\Models\KetquaThantai $ketquaThantai */
        $ketquaThantaiModel = new KetquaThantai();

        $ketquaThantaiData = factory(KetquaThantai::class)->make();
        foreach( $ketquaThantaiData->toFillableArray() as $key => $value ) {
            $ketquaThantaiModel->$key = $value;
        }
        $ketquaThantaiModel->save();

        $this->assertNotNull(KetquaThantai::find($ketquaThantaiModel->id));
    }

}
