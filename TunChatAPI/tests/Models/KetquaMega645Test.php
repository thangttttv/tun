<?php

namespace Tests\Models;

use App\Models\KetquaMega645;
use Tests\TestCase;

class KetquaMega645Test extends TestCase
{

    protected $useDatabase = true;

    public function testGetInstance()
    {
        /** @var  \App\Models\KetquaMega645 $ketquaMega645 */
        $ketquaMega645 = new KetquaMega645();
        $this->assertNotNull($ketquaMega645);
    }

    public function testStoreNew()
    {
        /** @var  \App\Models\KetquaMega645 $ketquaMega645 */
        $ketquaMega645Model = new KetquaMega645();

        $ketquaMega645Data = factory(KetquaMega645::class)->make();
        foreach( $ketquaMega645Data->toFillableArray() as $key => $value ) {
            $ketquaMega645Model->$key = $value;
        }
        $ketquaMega645Model->save();

        $this->assertNotNull(KetquaMega645::find($ketquaMega645Model->id));
    }

}
