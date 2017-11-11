<?php

namespace Tests\Models;

use App\Models\KetquaMiennam;
use Tests\TestCase;

class KetquaMiennamTest extends TestCase
{

    protected $useDatabase = true;

    public function testGetInstance()
    {
        /** @var  \App\Models\KetquaMiennam $ketquaMiennam */
        $ketquaMiennam = new KetquaMiennam();
        $this->assertNotNull($ketquaMiennam);
    }

    public function testStoreNew()
    {
        /** @var  \App\Models\KetquaMiennam $ketquaMiennam */
        $ketquaMiennamModel = new KetquaMiennam();

        $ketquaMiennamData = factory(KetquaMiennam::class)->make();
        foreach( $ketquaMiennamData->toFillableArray() as $key => $value ) {
            $ketquaMiennamModel->$key = $value;
        }
        $ketquaMiennamModel->save();

        $this->assertNotNull(KetquaMiennam::find($ketquaMiennamModel->id));
    }

}
