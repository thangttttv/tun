<?php
/**
 * Created by PhpStorm.
 * User: ThangTT
 * Date: 07/11/2017
 * Time: 12:18 SA.
 */
namespace App\Http\Responses\Api\V1;

class Subscribed extends Response
{
    protected $columns = [
        'id'           => 0,
        'name'         => '',
        'link'         => '',

    ];

    /**
     * @param $model
     *
     * @return static
     */
    public static function updateWithModel($model)
    {
        $response = new static([], 400);
        if (!empty($model)) {
            $modelArray = [
                'id'           => $model->id,
                'name'         => $model->name,
                'link'        => $model->link,

            ];
            $response = new static($modelArray, 200);
        }

        return $response;
    }
}
