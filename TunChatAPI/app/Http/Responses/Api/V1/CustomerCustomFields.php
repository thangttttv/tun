<?php
/**
 * Created by PhpStorm.
 * User: ThangTT
 * Date: 10/11/2017
 * Time: 2:45 CH
 */

namespace App\Http\Responses\Api\V1;


class CustomerCustomFields extends ListBase
{
	protected static $itemsResponseModel = CustomerCustomField::class;
}
