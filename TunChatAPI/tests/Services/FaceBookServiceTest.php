<?php
namespace Tests\Services;

use Tests\TestCase;

class FaceBookServiceTest extends TestCase
{

    public function testGetInstance()
    {
        /** @var  \App\Services\FaceBookServiceInterface $service */
        $service = \App::make(\App\Services\FaceBookServiceInterface::class);
        $this->assertNotNull($service);
    }

}
