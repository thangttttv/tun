<?php
namespace Tests\Smokes\Api\V1;

use App\Models\Group;
use App\Models\GroupInvitation;
use App\Models\GroupUser;
use App\Models\PushNotificationDevice;
use App\Services\Production\PushNotificationService;
use Mockery;

class MyGroupInvitationTest extends TestCase
{
    protected $useDatabase = true;
    protected $userService;
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

    public function testGetInvitations()
    {
        $header = $this->getAuthenticationHeader();

        $group = factory(Group::class)->create();

        $response = $this->call('GET', '/api/v1/me', [], [], [], $this->transformHeadersToServerVars($header));
        $userId   =  $response->original['id'];

        factory(GroupUser::class)->create(
            [
                'group_id'  => $group->id,
                'user_id'   => $userId,
                'role'      => GroupUser::ROLE_OWNER,
            ]

        );

        factory(GroupInvitation::class)->create(
            [
                'group_id'          => $group->id,
                'user_id'           => $userId,
                'inviter_user_id'   => 2,
            ]

        );

        $response = $this->call('GET', '/api/v1/me/groups/invitations', [], [], [], $this->transformHeadersToServerVars($header));
        $this->assertResponseStatus(200);

        $data = json_decode($response->getContent(), true);
        $this->assertArrayHasKey('items', $data);
        $this->assertEquals(1, count($data['items']));
    }

    public function testAccept()
    {
        $header = $this->getAuthenticationHeader();

        $this->mockedPushNotificationService
            ->shouldReceive('subscribeUserToGroup')
            ->times(1)
            ->withAnyArgs()
            ->andReturnNull();

        $response  = $this->call('GET', '/api/v1/me', [], [], [], $this->transformHeadersToServerVars($header));
        $user      = json_decode($response->getContent(), true);
        factory(PushNotificationDevice::class)->create([
            'user_id' => $user['id'],
        ]);
        $group      = factory(Group::class)->create();
        $invitation = factory(GroupInvitation::class)->create([
            'group_id'          => $group->id,
            'user_id'           => $user['id'],
            'inviter_user_id'   => 2,
        ]);

        $response = $this->call('GET', "/api/v1/me/groups/invitations/{$invitation->id}/accept", [], [], $this->transformHeadersToServerVars($header));
        $this->assertResponseStatus(200);
    }

    public function testReject()
    {
        $header = $this->getAuthenticationHeader();

        $response   = $this->call('GET', '/api/v1/me', [], [], [], $this->transformHeadersToServerVars($header));
        $user       = json_decode($response->getContent(), true);
        $group      = factory(Group::class)->create();
        $invitation = factory(GroupInvitation::class)->create([
            'group_id'          => $group->id,
            'user_id'           => $user['id'],
            'inviter_user_id'   => 2,
        ]);

        $response = $this->call('GET', "/api/v1/me/groups/invitations/{$invitation->id}/reject", [], [], $this->transformHeadersToServerVars($header));
        $this->assertResponseStatus(200);
    }
}
