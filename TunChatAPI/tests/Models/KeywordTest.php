<?php

namespace Tests\Models;

use App\Models\Keyword;
use Tests\TestCase;

class KeywordTest extends TestCase
{

    protected $useDatabase = true;

    public function testGetInstance()
    {
        /** @var  \App\Models\Keyword $keyword */
        $keyword = new Keyword();
        $this->assertNotNull($keyword);
    }

    public function testStoreNew()
    {
        /** @var  \App\Models\Keyword $keyword */
        $keywordModel = new Keyword();

        $keywordData = factory(Keyword::class)->make();
        foreach( $keywordData->toFillableArray() as $key => $value ) {
            $keywordModel->$key = $value;
        }
        $keywordModel->save();

        $this->assertNotNull(Keyword::find($keywordModel->id));
    }

}
