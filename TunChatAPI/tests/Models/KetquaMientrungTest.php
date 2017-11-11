<?php

namespace Tests\Models;

use App\Models\KetquaMientrung;
use Tests\TestCase;

class KetquaMientrungTest extends TestCase
{

    protected $useDatabase = true;

    public function testGetInstance()
    {
        /** @var  \App\Models\KetquaMientrung $ketquaMientrung */
        $ketquaMientrung = new KetquaMientrung();
        $this->assertNotNull($ketquaMientrung);
    }

    public function testStoreNew()
    {
        /** @var  \App\Models\KetquaMientrung $ketquaMientrung */
        $ketquaMientrungModel = new KetquaMientrung();

        $ketquaMientrungData = factory(KetquaMientrung::class)->make();
        foreach( $ketquaMientrungData->toFillableArray() as $key => $value ) {
            $ketquaMientrungModel->$key = $value;
        }
        $ketquaMientrungModel->save();

        $this->assertNotNull(KetquaMientrung::find($ketquaMientrungModel->id));
    }

}
