<?php

namespace Tests\Models;

use App\Models\PollOption;
use Tests\TestCase;

class PollOptionTest extends TestCase
{

    protected $useDatabase = true;

    public function testGetInstance()
    {
        /** @var  \App\Models\PollOption $pollOption */
        $pollOption = new PollOption();
        $this->assertNotNull($pollOption);
    }

    public function testStoreNew()
    {
        /** @var  \App\Models\PollOption $pollOption */
        $pollOptionModel = new PollOption();

        $pollOptionData = factory(PollOption::class)->make();
        foreach( $pollOptionData->toFillableArray() as $key => $value ) {
            $pollOptionModel->$key = $value;
        }
        $pollOptionModel->save();

        $this->assertNotNull(PollOption::find($pollOptionModel->id));
    }

}
