<?php

namespace Tests\Models;

use App\Models\EventImage;
use Tests\TestCase;

class EventImageTest extends TestCase
{

    protected $useDatabase = true;

    public function testGetInstance()
    {
        /** @var  \App\Models\EventImage $eventImage */
        $eventImage = new EventImage();
        $this->assertNotNull($eventImage);
    }

    public function testStoreNew()
    {
        /** @var  \App\Models\EventImage $eventImage */
        $eventImageModel = new EventImage();

        $eventImageData = factory(EventImage::class)->make();
        foreach( $eventImageData->toFillableArray() as $key => $value ) {
            $eventImageModel->$key = $value;
        }
        $eventImageModel->save();

        $this->assertNotNull(EventImage::find($eventImageModel->id));
    }

}
