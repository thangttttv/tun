<?php
/**
 * Created by PhpStorm.
 * User: ThangTT
 * Date: 13/11/2017
 * Time: 1:58 SA.
 */
namespace App\Http\Responses\Api\V1;

class Message extends Response
{
    protected $columns = [
        'id'                                            => 0,
        'page_id'                                       => 0,
        'title'                                         => '',
	    'type'                                          => '',
        'sent'                                          => 0,
        'delivered'                                     => 0,
        'opened'                                        => 0,
        'clicked'                                       => 0,

    ];

    /**
     * @param \App\Models\Message $model
     *
     * @return static
     */
    public static function updateWithModel($model)
    {
        $response = new static([], 400);
        if (!empty($model)) {
            $modelArray = [
                'id'                                            => $model->id,
                'page_id'                                       => $model->page_id,
                'title'                                         => $model->title,
	            'type'                                          => $model->type,
                'sent'                                          => $model->sent,
                'delivered'                                     => $model->delivered,
                'opened'                                        => $model->opened,
                'clicked'                                       => $model->clicked,
            ];

            $response = new static($modelArray, 200);
        }

        return $response;
    }
}
