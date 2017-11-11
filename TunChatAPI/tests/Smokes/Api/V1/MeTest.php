<?php
namespace Tests\Smokes\Api\V1;

use App\Models\PushNotificationDevice;
use App\Models\User;
use App\Services\Production\PushNotificationService;
use Mockery;

class MeTest extends TestCase
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

    public function testGetMe()
    {
        $email    = $this->faker->email;
        $password = $this->faker->password(8);

        $user = factory(User::class)->create([
            'email'    => $email,
            'password' => $password,
        ]);

        $headers = [];

        list($clientId, $clientSecret) = $this->getClientIdAndSecret();

        $input = [
            'email'         => $email,
            'password'      => $password,
            'client_id'     => $clientId,
            'client_secret' => $clientSecret,
        ];

        $response = $this->call('POST', '/api/v1/signin', $input, [], [],
            $this->transformHeadersToServerVars($headers));
        $data = json_decode($response->getContent(), true);
        $this->assertResponseStatus(200);

        $type  = $data['tokenType'];
        $token = $data['accessToken'];

        $headers = [
            'Authorization' => $type.' '.$token,
        ];

        $response = $this->call('GET', '/api/v1/me', [], [], [], $this->transformHeadersToServerVars($headers));

        $this->assertResponseStatus(200);

        $data = json_decode($response->getContent(), true);
        $this->assertEquals($data['email'], $user->email);
    }

    public function testMeUpdate()
    {
        $email    = $this->faker->email;
        $password = $this->faker->password(8);
        $user     = factory(User::class)->create([
            'email'    => $email,
            'password' => $password,
        ]);

        $headers = [];

        list($clientId, $clientSecret) = $this->getClientIdAndSecret();

        $input = [
            'email'         => $email,
            'password'      => $password,
            'client_id'     => $clientId,
            'client_secret' => $clientSecret,
        ];

        $response = $this->call('POST', '/api/v1/signin', $input, [], [],
            $this->transformHeadersToServerVars($headers));
        $data = json_decode($response->getContent(), true);
        $this->assertResponseStatus(200);

        $type  = $data['tokenType'];
        $token = $data['accessToken'];

        $headers = [
            'Authorization' => $type.' '.$token,
        ];

        $newEmail = $this->faker->email;
        $newName  = $this->faker->name;
        $input    = [
            'email' => $newEmail,
            'name'  => $newName,
        ];

        $response = $this->call('PUT', '/api/v1/me', $input, [], [], $this->transformHeadersToServerVars($headers));

        $this->assertResponseStatus(200);

        $data = json_decode($response->getContent(), true);
        $this->assertEquals($data['email'], $newEmail);
        $this->assertEquals($data['name'], $newName);
    }

    public function testAddDevice()
    {
        $header = $this->getAuthenticationHeader();

        $response = $this->call('GET', '/api/v1/me', [], [], [], $this->transformHeadersToServerVars($header));

        $user1 = json_decode($response->getContent(), true);

        $device = factory(PushNotificationDevice::class)->create([
            'user_id' => $user1['id'],
        ]);

        $input = [
            'token'                => $device->token,
            'type'                 => $device->type,
        ];

        $this->mockedPushNotificationService
            ->shouldReceive('subscribeDeviceToGroups')
            ->once()
            ->withAnyArgs()
            ->andReturn($device->token);

        $response = $this->call('POST', '/api/v1/me/devices', $input, [], [], $this->transformHeadersToServerVars($header));

        $this->assertResponseStatus(201);
    }
}
