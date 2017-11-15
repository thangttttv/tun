<?php
/**
 * Created by PhpStorm.
 * User: ThangTT
 * Date: 15/11/2017
 * Time: 4:21 CH
 */

namespace App\Http\Responses\Api\V1;


class Keywords extends ListBase
{
	protected static $itemsResponseModel = Keyword::class;
}