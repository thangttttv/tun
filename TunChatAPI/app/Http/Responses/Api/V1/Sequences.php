<?php
/**
 * Created by PhpStorm.
 * User: ThangTT
 * Date: 13/11/2017
 * Time: 12:12 SA
 */

namespace App\Http\Responses\Api\V1;


class Sequences extends ListBase
{
	protected static $itemsResponseModel = Sequence::class;
}