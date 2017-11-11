<?php

namespace Tests\Repositories;

use App\Models\Coupon;
use Tests\TestCase;

class CouponRepositoryTest extends TestCase
{
    protected $useDatabase = true;

    public function testGetInstance()
    {
        /** @var  \App\Repositories\CouponRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\CouponRepositoryInterface::class);
        $this->assertNotNull($repository);
    }

    public function testGetList()
    {
        $models = factory(Coupon::class, 3)->create();
        $couponIds = $models->pluck('id')->toArray();

        /** @var  \App\Repositories\CouponRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\CouponRepositoryInterface::class);
        $this->assertNotNull($repository);

        $modelsCheck = $repository->get('id', 'asc', 0, 1);
        $this->assertInstanceOf(Coupon::class, $modelsCheck[0]);

        $modelsCheck = $repository->getByIds($couponIds);
        $this->assertEquals(3, count($modelsCheck));
    }

    public function testFind()
    {
        $models = factory(Coupon::class, 3)->create();
        $couponIds = $models->pluck('id')->toArray();

        /** @var  \App\Repositories\CouponRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\CouponRepositoryInterface::class);
        $this->assertNotNull($repository);

        $couponCheck = $repository->find($couponIds[0]);
        $this->assertEquals($couponIds[0], $couponCheck->id);
    }

    public function testCreate()
    {
        $couponData = factory(Coupon::class)->make();

        /** @var  \App\Repositories\CouponRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\CouponRepositoryInterface::class);
        $this->assertNotNull($repository);

        $couponCheck = $repository->create($couponData->toFillableArray());
        $this->assertNotNull($couponCheck);
    }

    public function testUpdate()
    {
        $couponData = factory(Coupon::class)->create();

        /** @var  \App\Repositories\CouponRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\CouponRepositoryInterface::class);
        $this->assertNotNull($repository);

        $couponCheck = $repository->update($couponData, $couponData->toFillableArray());
        $this->assertNotNull($couponCheck);
    }

    public function testDelete()
    {
        $couponData = factory(Coupon::class)->create();

        /** @var  \App\Repositories\CouponRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\CouponRepositoryInterface::class);
        $this->assertNotNull($repository);

        $repository->delete($couponData);

        $couponCheck = $repository->find($couponData->id);
        $this->assertNull($couponCheck);
    }

}
