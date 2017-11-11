<?php
namespace Tests\Services;

use App\Models\Group;
use App\Models\User;
use Tests\TestCase;
use Carbon\Carbon;
use Faker\Generator;

class FirebaseServiceTest extends TestCase
{
    const DEFAULT_DELETE_RESPONSE = 'null';

    public function testGetInstance()
    {
        /** @var  \App\Services\FirebaseServiceInterface $service */
        $service = \App::make(\App\Services\FirebaseServiceInterface::class);
        $this->assertNotNull($service);
    }

}
