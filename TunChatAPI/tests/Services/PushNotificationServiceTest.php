<?php
namespace Tests\Services;

use Tests\TestCase;

class PushNotificationServiceTest extends TestCase
{

    public function testGetInstance()
    {
        /** @var  \App\Services\PushNotificationServiceInterface $service */
        $service = \App::make(\App\Services\PushNotificationServiceInterface::class);
        $this->assertNotNull($service);
    }

}
