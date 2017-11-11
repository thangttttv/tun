<?php

namespace Tests\Models;

use App\Models\EventAttendance;
use Tests\TestCase;

class EventAttendanceTest extends TestCase
{

    protected $useDatabase = true;

    public function testGetInstance()
    {
        /** @var  \App\Models\EventAttendance $eventAttendance */
        $eventAttendance = new EventAttendance();
        $this->assertNotNull($eventAttendance);
    }

    public function testStoreNew()
    {
        /** @var  \App\Models\EventAttendance $eventAttendance */
        $eventAttendanceModel = new EventAttendance();

        $eventAttendanceData = factory(EventAttendance::class)->make();
        foreach( $eventAttendanceData->toFillableArray() as $key => $value ) {
            $eventAttendanceModel->$key = $value;
        }
        $eventAttendanceModel->save();

        $this->assertNotNull(EventAttendance::find($eventAttendanceModel->id));
    }

}
