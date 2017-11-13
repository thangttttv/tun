<?php
/**
 * Created by PhpStorm.
 * User: ThangTT
 * Date: 13/11/2017
 * Time: 12:14 SA.
 */
namespace App\Http\Responses\Api\V1;

class SequenceMessage extends Response
{
    protected $columns=[
        'id'            => 0,
        'sequence_id'   => 0,
        'message_id'    => 0,
        'sent_after_day'=> 0,
        'send'          => 0,
        'opened'        => 0,
        'clicked'       => 0,
        'message'       => null,

    ];

    /**
     * @param \App\Models\SequenceMessage $model
     *
     * @return static
     */
    public static function updateWithModel($model)
    {
    	$message = Message::updateWithModel($model->message);
        $response=new static([], 400);
        if (!empty($model)) {
            $modelArray=[
                'id'            => $model->id,
                'sequence_id'   => $model->sequence_id,
                'message_id'    => $model->message_id,
                'sent_after_day'=> $model->sent_after_day,
                'send'          => $model->send,
                'opened'        => $model->opened,
                'clicked'       => $model->clicked,
                'message'       => $message->data,

            ];

            $response=new static($modelArray, 200);
        }

        return $response;
    }
}
