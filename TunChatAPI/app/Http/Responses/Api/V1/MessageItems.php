<?php
/**
 * Created by PhpStorm.
 * User: ThangTT
 * Date: 26/12/2017
 * Time: 2:04 CH
 */

namespace App\Http\Responses\Api\V1;




class MessageItems extends ListBase
{
	protected static $itemsResponseModel = MessageItem::class;
}