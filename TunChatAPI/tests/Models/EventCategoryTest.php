<?php

namespace Tests\Models;

use App\Models\EventCategory;
use Tests\TestCase;

class EventCategoryTest extends TestCase
{

    protected $useDatabase = true;

    public function testGetInstance()
    {
        /** @var  \App\Models\EventCategory $eventCategory */
        $eventCategory = new EventCategory();
        $this->assertNotNull($eventCategory);
    }

    public function testStoreNew()
    {
        /** @var  \App\Models\EventCategory $eventCategory */
        $eventCategoryModel = new EventCategory();

        $eventCategoryData = factory(EventCategory::class)->make();
        foreach( $eventCategoryData->toFillableArray() as $key => $value ) {
            $eventCategoryModel->$key = $value;
        }
        $eventCategoryModel->save();

        $this->assertNotNull(EventCategory::find($eventCategoryModel->id));
    }

}
