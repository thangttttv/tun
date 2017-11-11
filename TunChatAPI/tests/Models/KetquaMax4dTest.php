<?php

namespace Tests\Models;

use App\Models\KetquaMax4d;
use Tests\TestCase;

class KetquaMax4dTest extends TestCase
{

    protected $useDatabase = true;

    public function testGetInstance()
    {
        /** @var  \App\Models\KetquaMax4d $ketquaMax4d */
        $ketquaMax4d = new KetquaMax4d();
        $this->assertNotNull($ketquaMax4d);
    }

    public function testStoreNew()
    {
        /** @var  \App\Models\KetquaMax4d $ketquaMax4d */
        $ketquaMax4dModel = new KetquaMax4d();

        $ketquaMax4dData = factory(KetquaMax4d::class)->make();
        foreach( $ketquaMax4dData->toFillableArray() as $key => $value ) {
            $ketquaMax4dModel->$key = $value;
        }
        $ketquaMax4dModel->save();

        $this->assertNotNull(KetquaMax4d::find($ketquaMax4dModel->id));
    }

}
