<?php

namespace Tests\Models;

use App\Models\EventTicket;
use Tests\TestCase;

class EventTicketTest extends TestCase
{

    protected $useDatabase = true;

    public function testGetInstance()
    {
        /** @var  \App\Models\EventTicket $eventTicket */
        $eventTicket = new EventTicket();
        $this->assertNotNull($eventTicket);
    }

    public function testStoreNew()
    {
        /** @var  \App\Models\EventTicket $eventTicket */
        $eventTicketModel = new EventTicket();

        $eventTicketData = factory(EventTicket::class)->make();
        foreach( $eventTicketData->toFillableArray() as $key => $value ) {
            $eventTicketModel->$key = $value;
        }
        $eventTicketModel->save();

        $this->assertNotNull(EventTicket::find($eventTicketModel->id));
    }

}
