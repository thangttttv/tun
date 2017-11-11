<?php

namespace Tests\Models;

use App\Models\CustomerCustomField;
use Tests\TestCase;

class CustomerCustomFieldTest extends TestCase
{

    protected $useDatabase = true;

    public function testGetInstance()
    {
        /** @var  \App\Models\CustomerCustomField $customerCustomField */
        $customerCustomField = new CustomerCustomField();
        $this->assertNotNull($customerCustomField);
    }

    public function testStoreNew()
    {
        /** @var  \App\Models\CustomerCustomField $customerCustomField */
        $customerCustomFieldModel = new CustomerCustomField();

        $customerCustomFieldData = factory(CustomerCustomField::class)->make();
        foreach( $customerCustomFieldData->toFillableArray() as $key => $value ) {
            $customerCustomFieldModel->$key = $value;
        }
        $customerCustomFieldModel->save();

        $this->assertNotNull(CustomerCustomField::find($customerCustomFieldModel->id));
    }

}
