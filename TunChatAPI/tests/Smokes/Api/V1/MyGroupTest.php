<?php
namespace Tests\Smokes\Api\V1;

use App\Models\Group;
use App\Models\GroupUser;

class MyGroupTest extends TestCase
{
    protected $useDatabase = true;

    public function testGetUserGroup()
    {
        $header = $this->getAuthenticationHeader();

        $response = $this->call('GET', '/api/v1/me', [], [], [], $this->transformHeadersToServerVars($header));
        $user1    = json_decode($response->getContent(), true);

        $group1 = factory(Group::class)->create([
            'type' => Group::TYPE_PUBLIC,
        ]);

        $group2 = factory(Group::class)->create([
            'type' => Group::TYPE_SECRET,
        ]);

        $groupUser1 = factory(GroupUser::class)->create([
            'group_id' => $group1->id,
            'user_id'  => $user1['id'],
        ]);

        $groupUser2 = factory(GroupUser::class)->create([
            'group_id' => $group2->id,
            'user_id'  => $user1['id'],
        ]);

        $response = $this->call('GET', '/api/v1/me/groups', [], [], [], $this->transformHeadersToServerVars($header));
        $this->assertResponseStatus(200);
        $data = json_decode($response->getContent(), true);
        $this->assertArrayHasKey('items', $data);
        $this->assertEquals(2, count($data['items']));
        $this->assertEquals($group1->name, $data['items'][0]['group']['name']);
        $this->assertEquals($group1->favorite, $data['items'][0]['favorite']);
        $this->assertEquals($group2->name, $data['items'][1]['group']['name']);
        $this->assertEquals($group2->favorite, $data['items'][1]['favorite']);
    }

    public function testAddFavorite()
    {
        $header = $this->getAuthenticationHeader();

        $response = $this->call('GET', '/api/v1/me', [], [], [], $this->transformHeadersToServerVars($header));
        $user1    = json_decode($response->getContent(), true);

        $group1 = factory(Group::class)->create([
            'type' => Group::TYPE_PUBLIC,
        ]);

        $groupUser1 = factory(GroupUser::class)->create([
            'group_id' => $group1->id,
            'user_id'  => $user1['id'],
        ]);

        $input = [
            'group_id' => $group1->id,
        ];

        $response = $this->call('POST', '/api/v1/me/groups/'.$group1->id.'/favorite', $input, [], [], $this->transformHeadersToServerVars($header));

        $this->assertResponseStatus(200);
        $data = json_decode($response->getContent(), true);
    }

    public function testDeleteFavorite()
    {
        $header = $this->getAuthenticationHeader();

        $response = $this->call('GET', '/api/v1/me', [], [], [], $this->transformHeadersToServerVars($header));
        $user1    = json_decode($response->getContent(), true);

        $group1 = factory(Group::class)->create([
            'type' => Group::TYPE_PUBLIC,
        ]);

        $groupUser1 = factory(GroupUser::class)->create([
            'group_id' => $group1->id,
            'user_id'  => $user1['id'],
            'favorite' => true,
        ]);

        $response = $this->call('DELETE', '/api/v1/me/groups/'.$group1->id.'/favorite', [], [], [], $this->transformHeadersToServerVars($header));

        $this->assertResponseStatus(200);
        $data = json_decode($response->getContent(), true);
    }
}
