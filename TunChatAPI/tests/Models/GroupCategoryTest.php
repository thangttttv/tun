<?php

namespace Tests\Models;

use App\Models\GroupCategory;
use Tests\TestCase;

class GroupCategoryTest extends TestCase
{

    protected $useDatabase = true;

    public function testGetInstance()
    {
        /** @var  \App\Models\GroupCategory $groupCategory */
        $groupCategory = new GroupCategory();
        $this->assertNotNull($groupCategory);
    }

    public function testStoreNew()
    {
        /** @var  \App\Models\GroupCategory $groupCategory */
        $groupCategoryModel = new GroupCategory();

        $groupCategoryData = factory(GroupCategory::class)->make();
        foreach( $groupCategoryData->toFillableArray() as $key => $value ) {
            $groupCategoryModel->$key = $value;
        }
        $groupCategoryModel->save();

        $this->assertNotNull(GroupCategory::find($groupCategoryModel->id));
    }

}
