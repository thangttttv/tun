<?php

namespace Tests\Models;

use App\Models\Sequence;
use Tests\TestCase;

class SequenceTest extends TestCase
{

    protected $useDatabase = true;

    public function testGetInstance()
    {
        /** @var  \App\Models\Sequence $sequence */
        $sequence = new Sequence();
        $this->assertNotNull($sequence);
    }

    public function testStoreNew()
    {
        /** @var  \App\Models\Sequence $sequence */
        $sequenceModel = new Sequence();

        $sequenceData = factory(Sequence::class)->make();
        foreach( $sequenceData->toFillableArray() as $key => $value ) {
            $sequenceModel->$key = $value;
        }
        $sequenceModel->save();

        $this->assertNotNull(Sequence::find($sequenceModel->id));
    }

}
