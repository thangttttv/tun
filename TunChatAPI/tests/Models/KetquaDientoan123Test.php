<?php

namespace Tests\Models;

use App\Models\KetquaDientoan123;
use Tests\TestCase;

class KetquaDientoan123Test extends TestCase
{

    protected $useDatabase = true;

    public function testGetInstance()
    {
        /** @var  \App\Models\KetquaDientoan123 $ketquaDientoan123 */
        $ketquaDientoan123 = new KetquaDientoan123();
        $this->assertNotNull($ketquaDientoan123);
    }

    public function testStoreNew()
    {
        /** @var  \App\Models\KetquaDientoan123 $ketquaDientoan123 */
        $ketquaDientoan123Model = new KetquaDientoan123();

        $ketquaDientoan123Data = factory(KetquaDientoan123::class)->make();
        foreach( $ketquaDientoan123Data->toFillableArray() as $key => $value ) {
            $ketquaDientoan123Model->$key = $value;
        }
        $ketquaDientoan123Model->save();

        $this->assertNotNull(KetquaDientoan123::find($ketquaDientoan123Model->id));
    }

}
