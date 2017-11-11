<?php

namespace Tests\Models;

use App\Models\KetquaMienbac;
use Tests\TestCase;

class KetquaMienbacTest extends TestCase
{

    protected $useDatabase = true;

    public function testGetInstance()
    {
        /** @var  \App\Models\KetquaMienbac $ketquaMienbac */
        $ketquaMienbac = new KetquaMienbac();
        $this->assertNotNull($ketquaMienbac);
    }

    public function testStoreNew()
    {
        /** @var  \App\Models\KetquaMienbac $ketquaMienbac */
        $ketquaMienbacModel = new KetquaMienbac();

        $ketquaMienbacData = factory(KetquaMienbac::class)->make();
        foreach( $ketquaMienbacData->toFillableArray() as $key => $value ) {
            $ketquaMienbacModel->$key = $value;
        }
        $ketquaMienbacModel->save();

        $this->assertNotNull(KetquaMienbac::find($ketquaMienbacModel->id));
    }

}
