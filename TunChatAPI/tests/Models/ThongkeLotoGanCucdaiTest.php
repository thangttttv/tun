<?php

namespace Tests\Models;

use App\Models\ThongkeLotoGanCucdai;
use Tests\TestCase;

class ThongkeLotoGanCucdaiTest extends TestCase
{

    protected $useDatabase = true;

    public function testGetInstance()
    {
        /** @var  \App\Models\ThongkeLotoGanCucdai $thongkeLotoGanCucdai */
        $thongkeLotoGanCucdai = new ThongkeLotoGanCucdai();
        $this->assertNotNull($thongkeLotoGanCucdai);
    }

    public function testStoreNew()
    {
        /** @var  \App\Models\ThongkeLotoGanCucdai $thongkeLotoGanCucdai */
        $thongkeLotoGanCucdaiModel = new ThongkeLotoGanCucdai();

        $thongkeLotoGanCucdaiData = factory(ThongkeLotoGanCucdai::class)->make();
        foreach( $thongkeLotoGanCucdaiData->toFillableArray() as $key => $value ) {
            $thongkeLotoGanCucdaiModel->$key = $value;
        }
        $thongkeLotoGanCucdaiModel->save();

        $this->assertNotNull(ThongkeLotoGanCucdai::find($thongkeLotoGanCucdaiModel->id));
    }

}
