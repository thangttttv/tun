<?php
/**
 * Created by PhpStorm.
 * User: ThangTT
 * Date: 13/11/2017
 * Time: 12:07 SA.
 */
namespace App\Http\Responses\Api\V1;

class Sequence extends Response
{
    protected $columns = [
        'id'                                                   => 0,
        'page_id'                                              => 0,
        'title'                                                => '',
        'sent_date'                                            => '',
        'sent_time_from'                                       => '',
        'sent_time_to'                                         => '',
        'status'                                               => 0,
        'embedded'                                             => 0,
        'message'                                              => 0,
        'opened'                                               => 0,
        'clicked'                                              => 0,
        'sequenceMessages'                                     => null,
    ];

    /**
     * @param \App\Models\Sequence $model
     *
     * @return static
     */
    public static function updateWithModel($model)
    {
        $sequenceMessage = SequenceMessages::updateListWithModel($model->sequenceMessages);
        $response        = new static([], 400);
        if (!empty($model)) {
            $modelArray = [
                'id'                                                   => $model->id,
                'page_id'                                              => $model->page_id,
                'title'                                                => $model->title,
                'sent_date'                                            => $model->sent_date,
                'sent_time_from'                                       => $model->sent_time_from,
                'sent_time_to'                                         => $model->sent_time_to,
                'status'                                               => $model->status,
                'embedded'                                             => $model->embedded,
                'message'                                              => $model->message,
                'opened'                                               => $model->opened,
                'clicked'                                              => $model->clicked,
                'sequenceMessages'                                     => empty($sequenceMessage->data['items']) ? null : $sequenceMessage->data['items'],
            ];

            $response = new static($modelArray, 200);
        }

        return $response;
    }
}
