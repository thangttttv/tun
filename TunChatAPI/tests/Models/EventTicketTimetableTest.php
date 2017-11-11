<?php

namespace Tests\Models;

use App\Models\EventTicketTimetable;
use Tests\TestCase;

class EventTicketTimetableTest extends TestCase
{

    protected $useDatabase = true;

    public function testGetInstance()
    {
        /** @var  \App\Models\EventTicketTimetable $eventTicketTimetable */
        $eventTicketTimetable = new EventTicketTimetable();
        $this->assertNotNull($eventTicketTimetable);
    }

    public function testStoreNew()
    {
        /** @var  \App\Models\EventTicketTimetable $eventTicketTimetable */
        $eventTicketTimetableModel = new EventTicketTimetable();

        $eventTicketTimetableData = factory(EventTicketTimetable::class)->make();
        foreach( $eventTicketTimetableData->toFillableArray() as $key => $value ) {
            $eventTicketTimetableModel->$key = $value;
        }
        $eventTicketTimetableModel->save();

        $this->assertNotNull(EventTicketTimetable::find($eventTicketTimetableModel->id));
    }

}
