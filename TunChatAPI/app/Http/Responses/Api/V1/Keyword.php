<?php
/**
 * Created by PhpStorm.
 * User: ThangTT
 * Date: 15/11/2017
 * Time: 4:20 CH.
 */
namespace App\Http\Responses\Api\V1;

class Keyword extends Response
{
    protected $columns = [
        'id'                                        => 0,
        'title'                                     => '',
        'keyword_only'                              => '',
        'keyword_only_status'                       => 0,
        'keyword_in'                                => '',
        'keyword_in_status'                         => 0,
        'keyword_a_and_b'                           => '',
        'keyword_a_and_b_status'                    => 0,
        'keyword_a_not_b'                           => '',
        'keyword_a_not_b_status'                    => 0,
        'message_id'                                => 0,
    ];

    /**
     * @param \App\Models\Keyword $model
     *
     * @return static
     */
    public static function updateWithModel($model)
    {
        $response = new static([], 400);
        if (!empty($model)) {
            $modelArray = [
                'id'                                          => $model->id,
                'title'                                       => $model->title,
                'keyword_only'                                => $model->keyword_only,
                'keyword_only_status'                         => $model->keyword_only_status,
                'keyword_in'                                  => $model->keyword_in,
                'keyword_in_status'                           => $model->keyword_in_status,
                'keyword_a_and_b'                             => $model->keyword_a_and_b,
                'keyword_a_and_b_status'                      => $model->keyword_a_and_b_status,
                'keyword_a_not_b'                             => $model->keyword_a_not_b,
                'keyword_a_not_b_status'                      => $model->keyword_a_not_b_status,
                'message_id'                                  => $model->message_id,
            ];
            $response = new static($modelArray, 200);
        }

        return $response;
    }
}
