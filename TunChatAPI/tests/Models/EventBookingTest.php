<?php

namespace Tests\Models;

use App\Models\EventBooking;
use Tests\TestCase;

class EventBookingTest extends TestCase
{

    protected $useDatabase = true;

    public function testGetInstance()
    {
        /** @var  \App\Models\EventBooking $eventBooking */
        $eventBooking = new EventBooking();
        $this->assertNotNull($eventBooking);
    }

    public function testStoreNew()
    {
        /** @var  \App\Models\EventBooking $eventBooking */
        $eventBookingModel = new EventBooking();

        $eventBookingData = factory(EventBooking::class)->make();
        foreach( $eventBookingData->toFillableArray() as $key => $value ) {
            $eventBookingModel->$key = $value;
        }
        $eventBookingModel->save();

        $this->assertNotNull(EventBooking::find($eventBookingModel->id));
    }

}
