<?php

namespace Tests\Models;

use App\Models\KetquaDientoan6x36;
use Tests\TestCase;

class KetquaDientoan6x36Test extends TestCase
{

    protected $useDatabase = true;

    public function testGetInstance()
    {
        /** @var  \App\Models\KetquaDientoan6x36 $ketquaDientoan6x36 */
        $ketquaDientoan6x36 = new KetquaDientoan6x36();
        $this->assertNotNull($ketquaDientoan6x36);
    }

    public function testStoreNew()
    {
        /** @var  \App\Models\KetquaDientoan6x36 $ketquaDientoan6x36 */
        $ketquaDientoan6x36Model = new KetquaDientoan6x36();

        $ketquaDientoan6x36Data = factory(KetquaDientoan6x36::class)->make();
        foreach( $ketquaDientoan6x36Data->toFillableArray() as $key => $value ) {
            $ketquaDientoan6x36Model->$key = $value;
        }
        $ketquaDientoan6x36Model->save();

        $this->assertNotNull(KetquaDientoan6x36::find($ketquaDientoan6x36Model->id));
    }

}
