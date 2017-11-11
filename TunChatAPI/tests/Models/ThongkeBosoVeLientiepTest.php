<?php

namespace Tests\Models;

use App\Models\ThongkeBosoVeLientiep;
use Tests\TestCase;

class ThongkeBosoVeLientiepTest extends TestCase
{

    protected $useDatabase = true;

    public function testGetInstance()
    {
        /** @var  \App\Models\ThongkeBosoVeLientiep $thongkeBosoVeLientiep */
        $thongkeBosoVeLientiep = new ThongkeBosoVeLientiep();
        $this->assertNotNull($thongkeBosoVeLientiep);
    }

    public function testStoreNew()
    {
        /** @var  \App\Models\ThongkeBosoVeLientiep $thongkeBosoVeLientiep */
        $thongkeBosoVeLientiepModel = new ThongkeBosoVeLientiep();

        $thongkeBosoVeLientiepData = factory(ThongkeBosoVeLientiep::class)->make();
        foreach( $thongkeBosoVeLientiepData->toFillableArray() as $key => $value ) {
            $thongkeBosoVeLientiepModel->$key = $value;
        }
        $thongkeBosoVeLientiepModel->save();

        $this->assertNotNull(ThongkeBosoVeLientiep::find($thongkeBosoVeLientiepModel->id));
    }

}
