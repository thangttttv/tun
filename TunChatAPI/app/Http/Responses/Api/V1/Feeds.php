<?php
/**
 * Created by PhpStorm.
 * User: ThangTT
 * Date: 09/11/2017
 * Time: 5:38 CH
 */

namespace App\Http\Responses\Api\V1;


class Feeds extends ListBase
{
	protected static $itemsResponseModel = Feed::class;
}