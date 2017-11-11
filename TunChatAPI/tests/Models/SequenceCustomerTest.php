<?php

namespace Tests\Models;

use App\Models\SequenceCustomer;
use Tests\TestCase;

class SequenceCustomerTest extends TestCase
{

    protected $useDatabase = true;

    public function testGetInstance()
    {
        /** @var  \App\Models\SequenceCustomer $sequenceCustomer */
        $sequenceCustomer = new SequenceCustomer();
        $this->assertNotNull($sequenceCustomer);
    }

    public function testStoreNew()
    {
        /** @var  \App\Models\SequenceCustomer $sequenceCustomer */
        $sequenceCustomerModel = new SequenceCustomer();

        $sequenceCustomerData = factory(SequenceCustomer::class)->make();
        foreach( $sequenceCustomerData->toFillableArray() as $key => $value ) {
            $sequenceCustomerModel->$key = $value;
        }
        $sequenceCustomerModel->save();

        $this->assertNotNull(SequenceCustomer::find($sequenceCustomerModel->id));
    }

}
