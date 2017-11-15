<?php

namespace Tests\Models;

use App\Models\KeywordAction;
use Tests\TestCase;

class KeywordActionTest extends TestCase
{

    protected $useDatabase = true;

    public function testGetInstance()
    {
        /** @var  \App\Models\KeywordAction $keywordAction */
        $keywordAction = new KeywordAction();
        $this->assertNotNull($keywordAction);
    }

    public function testStoreNew()
    {
        /** @var  \App\Models\KeywordAction $keywordAction */
        $keywordActionModel = new KeywordAction();

        $keywordActionData = factory(KeywordAction::class)->make();
        foreach( $keywordActionData->toFillableArray() as $key => $value ) {
            $keywordActionModel->$key = $value;
        }
        $keywordActionModel->save();

        $this->assertNotNull(KeywordAction::find($keywordActionModel->id));
    }

}
