<?php
namespace Tests\Smokes\Api\V1;

use App\Models\Event;
use App\Models\Group;
use App\Models\GroupUser;
use App\Models\PushNotificationDevice;
use App\Models\User;
use App\Services\Production\PushNotificationService;
use Mockery;

class GroupTest extends TestCase
{
    protected $useDatabase = true;

    protected $mockedPushNotificationService;

    public function setUp()
    {
        parent::setUp();

        $this->mockedPushNotificationService = Mockery::mock(PushNotificationService::class);
        app()->instance(PushNotificationService::class, $this->mockedPushNotificationService);
    }

    public function tearDown()
    {
        parent::tearDown();

        Mockery::close();
    }

    public function testGetGroup()
    {
        $header = $this->getAuthenticationHeader();

        $group1 = factory(Group::class)->create([
            'type' => Group::TYPE_PUBLIC,
        ]);
        $group2 = factory(Group::class)->create([
            'type' => Group::TYPE_SECRET,
        ]);

        $response = $this->call('GET', '/api/v1/groups', [], [], [], $this->transformHeadersToServerVars($header));
        $this->assertResponseStatus(200);

        $data = json_decode($response->getContent(), true);

        $this->assertArrayHasKey('items', $data);
        $this->assertEquals(1, count($data['items']));
        $this->assertEquals($group1->name, $data['items'][0]['name']);
    }

    public function testCreateGroup()
    {
        $this->mockedPushNotificationService
            ->shouldReceive('subscribeUserToGroup')
            ->times(3)
            ->withAnyArgs()
            ->andReturnNull();

        $header = $this->getAuthenticationHeader();

        $input = [
            'name' => $this->faker->name,
            'type' => Group::TYPE_PUBLIC,
        ];

        $response = $this->call('POST', '/api/v1/groups', $input, [], [], $this->transformHeadersToServerVars($header));
        $this->assertResponseStatus(201);

        $response = $this->call('GET', '/api/v1/groups', [], [], [], $this->transformHeadersToServerVars($header));
        $this->assertResponseStatus(200);

        $data = json_decode($response->getContent(), true);
        $this->assertArrayHasKey('items', $data);
        $this->assertEquals(1, count($data['items']));

        $input = [
            'name' => $this->faker->name,
            'type' => Group::TYPE_PUBLIC,
        ];

        $response = $this->call('POST', '/api/v1/groups', $input, [], [], $this->transformHeadersToServerVars($header));
        $this->assertResponseStatus(201);

        $response = $this->call('GET', '/api/v1/groups', [], [], [], $this->transformHeadersToServerVars($header));
        $this->assertResponseStatus(200);

        $data = json_decode($response->getContent(), true);
        $this->assertArrayHasKey('items', $data);
        $this->assertEquals(2, count($data['items']));

        $input = [
            'name' => $this->faker->name,
            'type' => Group::TYPE_SECRET,
        ];

        $response = $this->call('POST', '/api/v1/groups', $input, [], [], $this->transformHeadersToServerVars($header));
        $this->assertResponseStatus(201);

        $response = $this->call('GET', '/api/v1/groups', [], [], [], $this->transformHeadersToServerVars($header));
        $this->assertResponseStatus(200);

        $data = json_decode($response->getContent(), true);

        $this->assertArrayHasKey('items', $data);
        $this->assertEquals(2, count($data['items']));
    }

    public function testUpdateGroup()
    {
        $header = $this->getAuthenticationHeader();

        $name  = $this->faker->name;
        $input = [
            'name' => $name,
            'type' => Group::TYPE_PUBLIC,
        ];

        $this->mockedPushNotificationService
            ->shouldReceive('subscribeUserToGroup')
            ->times(1)
            ->withAnyArgs()
            ->andReturnNull();

        $response = $this->call('POST', '/api/v1/groups', $input, [], [], $this->transformHeadersToServerVars($header));
        $this->assertResponseStatus(201);
        $data = json_decode($response->getContent(), true);

        $id = $data['id'];

        $response = $this->call('GET', '/api/v1/groups', [], [], [], $this->transformHeadersToServerVars($header));
        $this->assertResponseStatus(200);

        $data = json_decode($response->getContent(), true);
        $this->assertArrayHasKey('items', $data);
        $this->assertEquals(1, count($data['items']));
        $this->assertEquals($name, $data['items'][0]['name']);

        $newName = $this->faker->name;

        $input = [
            'name' => $newName,
            'type' => Group::TYPE_PUBLIC,
        ];

        $response = $this->call('PUT', '/api/v1/groups/'.$id, $input, [], [],
            $this->transformHeadersToServerVars($header));
        $this->assertResponseStatus(200);

        $response = $this->call('GET', '/api/v1/groups', [], [], [], $this->transformHeadersToServerVars($header));
        $this->assertResponseStatus(200);

        $data = json_decode($response->getContent(), true);
        $this->assertArrayHasKey('items', $data);
        $this->assertEquals(1, count($data['items']));
        $this->assertEquals($newName, $data['items'][0]['name']);

        $input = [
            'name' => $newName,
            'type' => Group::TYPE_SECRET,
        ];

        $response = $this->call('PUT', '/api/v1/groups/'.$id, $input, [], [], $this->transformHeadersToServerVars($header));
        $this->assertResponseStatus(200);

        $response = $this->call('GET', '/api/v1/groups', [], [], [], $this->transformHeadersToServerVars($header));
        $this->assertResponseStatus(200);

        $data = json_decode($response->getContent(), true);

        $this->assertArrayHasKey('items', $data);
        $this->assertEquals(0, count($data['items']));
    }

    public function testGetGroupEvents()
    {
        $header = $this->getAuthenticationHeader();

        $group1 = factory(Group::class)->create([
            'type' => Group::TYPE_PUBLIC,
        ]);

        $event1 = factory(Event::class)->create([
            'group_id' => $group1->id,
        ]);

        $event2 = factory(Event::class)->create([
            'group_id' => $group1->id,
        ]);

        $response = $this->call('GET', '/api/v1/groups/'.$group1->id.'/events', [], [], [], $this->transformHeadersToServerVars($header));

        $this->assertResponseStatus(200);
        $data = json_decode($response->getContent(), true);
        $this->assertArrayHasKey('items', $data);
        $this->assertEquals(2, count($data['items']));
        $this->assertEquals($event1->name, $data['items'][0]['name']);
        $this->assertEquals($event2->name, $data['items'][1]['name']);
    }

    public function testInvite()
    {
        $header    = $this->getAuthenticationHeader();
        $group     = factory(Group::class)->create();
        $response  = $this->call('GET', '/api/v1/me', [], [], [], $this->transformHeadersToServerVars($header));
        $user      = json_decode($response->getContent(), true);
        factory(GroupUser::class)->create([
            'user_id'  => $user['id'],
            'group_id' => $group->id,
        ]);
        $invitee = factory(User::class)->create();
        factory(PushNotificationDevice::class)->create([
            'user_id' => $invitee->id,
        ]);

        $input   = [
            'user_id' => $invitee->id,
        ];

        $this->mockedPushNotificationService
            ->shouldReceive('sendMessageToUser')
            ->times(1)
            ->withAnyArgs()
            ->andReturnNull();

        $this->call('POST', '/api/v1/groups/'.$group->id.'/invite', $input, [], [], $this->transformHeadersToServerVars($header));
        $this->assertResponseStatus(200);
    }

    public function testJoinGroup()
    {
        $header = $this->getAuthenticationHeader();

        $input = [
            'name' => $this->faker->name,
            'type' => Group::TYPE_PUBLIC,
        ];

        $this->mockedPushNotificationService
            ->shouldReceive('subscribeUserToGroup')
            ->times(1)
            ->withAnyArgs()
            ->andReturnNull();

        $response = $this->call('POST', '/api/v1/groups', $input, [], [], $this->transformHeadersToServerVars($header));
        $this->assertResponseStatus(201);
        $groupId = $response->original['id'];

        $response=$this->call('GET', '/api/v1/groups/'.$groupId.'/join', [], [], [], $this->transformHeadersToServerVars($header));
        $this->assertResponseStatus(200);
    }

    public function testLeaveGroup()
    {
        $header = $this->getAuthenticationHeader();

        $input = [
            'name' => $this->faker->name,
            'type' => Group::TYPE_PUBLIC,
        ];

        $this->mockedPushNotificationService
            ->shouldReceive('subscribeUserToGroup')
            ->times(1)
            ->withAnyArgs()
            ->andReturnNull();

        $response = $this->call('POST', '/api/v1/groups', $input, [], [], $this->transformHeadersToServerVars($header));
        $this->assertResponseStatus(201);
        $groupId = $response->original['id'];

        $response=$this->call('GET', '/api/v1/groups/'.$groupId.'/join', [], [], [], $this->transformHeadersToServerVars($header));
        $this->assertResponseStatus(200);

        $response=$this->call('GET', '/api/v1/groups/'.$groupId.'/leave', [], [], [], $this->transformHeadersToServerVars($header));
        $this->assertResponseStatus(400);
    }
}
