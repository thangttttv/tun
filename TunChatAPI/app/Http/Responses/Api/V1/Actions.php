<?php
/**
 * Created by PhpStorm.
 * User: ThangTT
 * Date: 15/11/2017
 * Time: 4:17 CH
 */

namespace App\Http\Responses\Api\V1;


class Actions extends ListBase
{
	protected static $itemsResponseModel = Action::class;
}