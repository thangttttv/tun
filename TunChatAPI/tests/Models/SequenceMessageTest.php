<?php

namespace Tests\Models;

use App\Models\SequenceMessage;
use Tests\TestCase;

class SequenceMessageTest extends TestCase
{

    protected $useDatabase = true;

    public function testGetInstance()
    {
        /** @var  \App\Models\SequenceMessage $sequenceMessage */
        $sequenceMessage = new SequenceMessage();
        $this->assertNotNull($sequenceMessage);
    }

    public function testStoreNew()
    {
        /** @var  \App\Models\SequenceMessage $sequenceMessage */
        $sequenceMessageModel = new SequenceMessage();

        $sequenceMessageData = factory(SequenceMessage::class)->make();
        foreach( $sequenceMessageData->toFillableArray() as $key => $value ) {
            $sequenceMessageModel->$key = $value;
        }
        $sequenceMessageModel->save();

        $this->assertNotNull(SequenceMessage::find($sequenceMessageModel->id));
    }

}
