<?php
namespace Tests\Services;

use Tests\TestCase;

class FcmServiceTest extends TestCase
{

    public function testGetInstance()
    {
        /** @var  \App\Services\FcmServiceInterface $service */
        $service = \App::make(\App\Services\FcmServiceInterface::class);
        $this->assertNotNull($service);
    }

}
