<?php

namespace Tests\Models;

use App\Models\Poll;
use Tests\TestCase;

class PollTest extends TestCase
{

    protected $useDatabase = true;

    public function testGetInstance()
    {
        /** @var  \App\Models\Poll $poll */
        $poll = new Poll();
        $this->assertNotNull($poll);
    }

    public function testStoreNew()
    {
        /** @var  \App\Models\Poll $poll */
        $pollModel = new Poll();

        $pollData = factory(Poll::class)->make();
        foreach( $pollData->toFillableArray() as $key => $value ) {
            $pollModel->$key = $value;
        }
        $pollModel->save();

        $this->assertNotNull(Poll::find($pollModel->id));
    }

}
