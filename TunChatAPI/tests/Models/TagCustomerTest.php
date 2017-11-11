<?php

namespace Tests\Models;

use App\Models\TagCustomer;
use Tests\TestCase;

class TagCustomerTest extends TestCase
{

    protected $useDatabase = true;

    public function testGetInstance()
    {
        /** @var  \App\Models\TagCustomer $tagCustomer */
        $tagCustomer = new TagCustomer();
        $this->assertNotNull($tagCustomer);
    }

    public function testStoreNew()
    {
        /** @var  \App\Models\TagCustomer $tagCustomer */
        $tagCustomerModel = new TagCustomer();

        $tagCustomerData = factory(TagCustomer::class)->make();
        foreach( $tagCustomerData->toFillableArray() as $key => $value ) {
            $tagCustomerModel->$key = $value;
        }
        $tagCustomerModel->save();

        $this->assertNotNull(TagCustomer::find($tagCustomerModel->id));
    }

}
