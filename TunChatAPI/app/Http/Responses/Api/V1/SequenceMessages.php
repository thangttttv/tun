<?php
/**
 * Created by PhpStorm.
 * User: ThangTT
 * Date: 13/11/2017
 * Time: 12:14 SA
 */

namespace App\Http\Responses\Api\V1;


class SequenceMessages extends ListBase
{
	protected static $itemsResponseModel = SequenceMessage::class;
}