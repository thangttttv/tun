<?php
/**
 * Created by PhpStorm.
 * User: ThangTT
 * Date: 26/12/2017
 * Time: 1:53 CH.
 */
namespace App\Http\Responses\Api\V1;

class MessageItem extends Response
{
    protected $columns=[
        'id'        => 0,
        'message_id'=> 0,
        'type'      => '',
        'message'   => '',

    ];

    /**
     * @param \App\Models\MessageItem $model
     *
     * @return static
     */
    public static function updateWithModel($model)
    {
        $response=new static([], 400);
        if (!empty($model)) {
            $modelArray=[
                'id'        => $model->id,
                'message_id'=> $model->message_id,
                'type'      => $model->type,
                'message'   => $model->message,
            ];

            $response=new static($modelArray, 200);
        }

        return $response;
    }
}
