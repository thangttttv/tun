<?php

namespace Tests\Models;

use App\Models\PollAnswer;
use Tests\TestCase;

class PollAnswerTest extends TestCase
{

    protected $useDatabase = true;

    public function testGetInstance()
    {
        /** @var  \App\Models\PollAnswer $pollAnswer */
        $pollAnswer = new PollAnswer();
        $this->assertNotNull($pollAnswer);
    }

    public function testStoreNew()
    {
        /** @var  \App\Models\PollAnswer $pollAnswer */
        $pollAnswerModel = new PollAnswer();

        $pollAnswerData = factory(PollAnswer::class)->make();
        foreach( $pollAnswerData->toFillableArray() as $key => $value ) {
            $pollAnswerModel->$key = $value;
        }
        $pollAnswerModel->save();

        $this->assertNotNull(PollAnswer::find($pollAnswerModel->id));
    }

}
