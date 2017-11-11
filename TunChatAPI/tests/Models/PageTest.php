<?php

namespace Tests\Models;

use App\Models\Page;
use Tests\TestCase;

class PageTest extends TestCase
{

    protected $useDatabase = true;

    public function testGetInstance()
    {
        /** @var  \App\Models\Page $page */
        $page = new Page();
        $this->assertNotNull($page);
    }

    public function testStoreNew()
    {
        /** @var  \App\Models\Page $page */
        $pageModel = new Page();

        $pageData = factory(Page::class)->make();
        foreach( $pageData->toFillableArray() as $key => $value ) {
            $pageModel->$key = $value;
        }
        $pageModel->save();

        $this->assertNotNull(Page::find($pageModel->id));
    }

}
