<?php

namespace Tests\Models;

use App\Models\Coupon;
use Tests\TestCase;

class CouponTest extends TestCase
{

    protected $useDatabase = true;

    public function testGetInstance()
    {
        /** @var  \App\Models\Coupon $coupon */
        $coupon = new Coupon();
        $this->assertNotNull($coupon);
    }

    public function testStoreNew()
    {
        /** @var  \App\Models\Coupon $coupon */
        $couponModel = new Coupon();

        $couponData = factory(Coupon::class)->make();
        foreach( $couponData->toFillableArray() as $key => $value ) {
            $couponModel->$key = $value;
        }
        $couponModel->save();

        $this->assertNotNull(Coupon::find($couponModel->id));
    }

}
