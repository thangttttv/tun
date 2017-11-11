<?php

namespace Tests\Models;

use App\Models\Tag;
use Tests\TestCase;

class TagTest extends TestCase
{

    protected $useDatabase = true;

    public function testGetInstance()
    {
        /** @var  \App\Models\Tag $tag */
        $tag = new Tag();
        $this->assertNotNull($tag);
    }

    public function testStoreNew()
    {
        /** @var  \App\Models\Tag $tag */
        $tagModel = new Tag();

        $tagData = factory(Tag::class)->make();
        foreach( $tagData->toFillableArray() as $key => $value ) {
            $tagModel->$key = $value;
        }
        $tagModel->save();

        $this->assertNotNull(Tag::find($tagModel->id));
    }

}
