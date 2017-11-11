<?php
/**
 * Created by PhpStorm.
 * User: ThangTT
 * Date: 08/11/2017
 * Time: 5:37 CH
 */

namespace App\Http\Responses\Api\V1;


class Customers extends ListBase
{
	protected static $itemsResponseModel = Customer::class;
}