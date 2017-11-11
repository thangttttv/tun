<?php
namespace Tests\Smokes\Api\V1;

use App\Models\Category;
use App\Repositories\Eloquent\CategoryRepository;

class CategoryTest extends TestCase
{
    protected $useDatabase = true;
    protected $categoryRepository;

    public function testGetCategories()
    {

        $categoryRepository = new CategoryRepository();
        $category = factory(Category::class)->create();

        $count = $categoryRepository->count();
        $response = $this->call('GET', '/api/v1/categories', [], [], [], $this->transformHeadersToServerVars([]));
        $this->assertResponseStatus(200);

        $data = json_decode($response->getContent(), true);

        $this->assertArrayHasKey('items', $data);
        $this->assertEquals($count, count($data['items']));
        $this->assertEquals($category->name, $data['items'][$count-1]['name']);
    }

}
