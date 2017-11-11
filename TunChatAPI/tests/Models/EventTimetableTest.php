<?php

namespace Tests\Models;

use App\Models\EventTimetable;
use Tests\TestCase;

class EventTimetableTest extends TestCase
{

    protected $useDatabase = true;

    public function testGetInstance()
    {
        /** @var  \App\Models\EventTimetable $eventTimetable */
        $eventTimetable = new EventTimetable();
        $this->assertNotNull($eventTimetable);
    }

    public function testStoreNew()
    {
        /** @var  \App\Models\EventTimetable $eventTimetable */
        $eventTimetableModel = new EventTimetable();

        $eventTimetableData = factory(EventTimetable::class)->make();
        foreach( $eventTimetableData->toFillableArray() as $key => $value ) {
            $eventTimetableModel->$key = $value;
        }
        $eventTimetableModel->save();

        $this->assertNotNull(EventTimetable::find($eventTimetableModel->id));
    }

}
