<?php
/**
 * Created by PhpStorm.
 * User: ThangTT
 * Date: 11/11/2017
 * Time: 1:44 SA
 */

namespace App\Http\Responses\Api\V1;


class Tags extends ListBase
{
	protected static $itemsResponseModel = Tag::class;
}
