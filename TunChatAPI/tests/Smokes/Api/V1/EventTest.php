<?php
namespace Tests\Smokes\Api\V1;

use App\Models\Event;
use App\Models\EventBooking;
use App\Models\EventTicket;
use App\Models\Interest;
use Carbon\Carbon;

class EventTest extends TestCase
{
    protected $useDatabase = true;
    protected $eventRepository;

    public function testEvents()
    {
        $header = $this->getAuthenticationHeader();

        $event1 = factory(Event::class)->create(
            [
                'is_public' => true,
            ]
        );
        $event2 = factory(Event::class)->create(
            [
                'is_public' => true,
            ]
        );

        $response = $this->call('GET', '/api/v1/events', [], [], [], $this->transformHeadersToServerVars($header));
        $this->assertResponseStatus(200);

        $data = json_decode($response->getContent(), true);

        $this->assertArrayHasKey('items', $data);
        $this->assertEquals(2, count($data['items']));
    }

    public function testEventsSortByInterestCount()
    {
        $header = $this->getAuthenticationHeader();

        $event1 = factory(Event::class)->create(
            [
                'is_public' => true,
            ]
        );
        $event2 = factory(Event::class)->create(
            [
                'is_public' => true,
            ]
        );

        $interest1 = factory(Interest::class)->create([
            'event_id' => $event1->id,
            'user_id'  => 1,
        ]);
        $interest2 = factory(Interest::class)->create([
            'event_id' => $event1->id,
            'user_id'  => 2,
        ]);

        $input = [
            'order'     => 'interested_count',
            'direction' => 'desc',
        ];

        $response = $this->call('GET', '/api/v1/events', $input, [], [], $this->transformHeadersToServerVars($header));
        $this->assertResponseStatus(200);

        $data = json_decode($response->getContent(), true);

        $this->assertArrayHasKey('items', $data);
        $this->assertEquals(2, count($data['items']));
        $this->assertEquals($event1->id, $data['items'][0]['id']);
        $this->assertEquals($event2->id, $data['items'][1]['id']);
    }

    public function testEventsSortByParticipantCount()
    {
        $header = $this->getAuthenticationHeader();

        $event1 = factory(Event::class)->create(
            [
                'is_public' => true,
            ]
        );
        $event2 = factory(Event::class)->create(
            [
                'is_public' => true,
            ]
        );

        $eventTicket1 = factory(EventTicket::class)->create([
            'event_id' => $event1->id,
        ]);
        $eventTicket2 = factory(EventTicket::class)->create([
            'event_id' => $event1->id,
        ]);
        $eventTicket3 = factory(EventTicket::class)->create([
            'event_id' => $event2->id,
        ]);
        $eventBooking1 = factory(EventBooking::class)->create([
            'event_ticket_id' => $eventTicket1->id,
            'quantity'        => 5,
        ]);
        $eventBooking2 = factory(EventBooking::class)->create([
            'event_ticket_id' => $eventTicket2->id,
            'quantity'        => 2,
        ]);
        $eventBooking3 = factory(EventBooking::class)->create([
            'event_ticket_id' => $eventTicket3->id,
            'quantity'        => 1,
        ]);

        $input = [
            'order'     => 'participant_count',
            'direction' => 'desc',
        ];

        $response = $this->call('GET', '/api/v1/events', $input, [], [], $this->transformHeadersToServerVars($header));
        $this->assertResponseStatus(200);

        $data = json_decode($response->getContent(), true);

        $this->assertArrayHasKey('items', $data);
        $this->assertEquals(2, count($data['items']));
        $this->assertEquals($event1->id, $data['items'][0]['id']);
        $this->assertEquals($eventBooking1->quantity + $eventBooking2->quantity, $data['items'][0]['participantCount']);

        $this->assertEquals($event2->id, $data['items'][1]['id']);
        $this->assertEquals($eventBooking3->quantity, $data['items'][1]['participantCount']);
    }

    public function testCreateEvent()
    {
        $header = $this->getAuthenticationHeader();

        $categories    = [$this->faker->numberBetween(1, 8), $this->faker->numberBetween(1, 8), $this->faker->numberBetween(1, 8)];
        $pollStartDate = [$this->faker->date('Y-m-d'), $this->faker->date('Y-m-d'), $this->faker->date('Y-m-d')];
        $pollStartTime = [$this->faker->date('H:i'), $this->faker->date('H:i'), $this->faker->date('H:i')];
        $pollLocation  = [$this->faker->text(50), $this->faker->text(50), $this->faker->text(50)];

        $input = [
            'name'              => $this->faker->name,
            'duration'          => $this->faker->numberBetween(1, 100),
            'slots'             => $this->faker->numberBetween(1, 100),
            'start_at'          => $this->faker->unixTime,
            'location'          => $this->faker->text(200),
            'description'       => $this->faker->text(),
            'is_public'         => 1,
            'category_id'       => $categories,
            'poll_start_date'   => $pollStartDate,
            'poll_start_time'   => $pollStartTime,
            'poll_location'     => $pollLocation,
        ];

        $response = $this->call('POST', '/api/v1/events', $input, [], [], $this->transformHeadersToServerVars($header));
        $this->assertResponseStatus(201);
    }

    public function testBookEvent()
    {
        $header = $this->getAuthenticationHeader();

        $event       = factory(Event::class)->create();
        $eventTicket = factory(EventTicket::class)->create([
            'event_id'         => $event->id,
            'quantity'         => 100,
            'booking_start_at' => Carbon::now()->addDay(-1)->timestamp,
            'booking_end_at'   => Carbon::now()->addDay(1)->timestamp,
        ]);

        $input = [
            'event_ticket_id'      => $eventTicket->id,
            'quantity'             => 3,
            'payment_method_nonce' => 'payment_method_nonce',
        ];

        $response = $this->call('POST', '/api/v1/events/'.$event->id.'/bookings', $input, [], [], $this->transformHeadersToServerVars($header));
        $this->assertResponseStatus(200);
    }
}
