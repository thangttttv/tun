<?php

namespace Tests\Models;

use App\Models\Event;
use Tests\TestCase;

class EventTest extends TestCase
{

    protected $useDatabase = true;

    public function testGetInstance()
    {
        /** @var  \App\Models\Event $event */
        $event = new Event();
        $this->assertNotNull($event);
    }

    public function testStoreNew()
    {
        /** @var  \App\Models\Event $event */
        $eventModel = new Event();

        $eventData = factory(Event::class)->make();
        foreach( $eventData->toFillableArray() as $key => $value ) {
            $eventModel->$key = $value;
        }
        $eventModel->save();

        $this->assertNotNull(Event::find($eventModel->id));
    }

}
