<?php

namespace Tests\Smokes\Api\V1;
use App\Models\Group;

class MessageTest extends TestCase
{

   public function testSend()
     {
         $header = $this->getAuthenticationHeader();

	     $input = [
		     'name' => $this->faker->name,
		     'type' => Group::TYPE_PUBLIC,
	     ];

	     $response = $this->call('POST', '/api/v1/groups', $input, [], [], $this->transformHeadersToServerVars($header));
	     $this->assertResponseStatus(201);
	     $groupId = $response->original["id"];

	     $response=$this->call('GET', '/api/v1/groups/'.$groupId.'/join', [], [], [], $this->transformHeadersToServerVars($header));
	     $this->assertResponseStatus(200);

         $input = [
             'content'      => $this->faker->text(200),
             'group_id'     => $groupId,
             'reference_id' => "",
             'type'         => "image",
         ];

         $response = $this->call('POST', '/api/v1/groups/'.$groupId.'/messages', $input, [], [], $this->transformHeadersToServerVars($header));
         $this->assertResponseStatus(201);
     }

}