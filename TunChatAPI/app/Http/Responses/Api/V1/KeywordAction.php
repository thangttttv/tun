<?php
/**
 * Created by PhpStorm.
 * User: ThangTT
 * Date: 16/11/2017
 * Time: 12:50 SA.
 */
namespace App\Http\Responses\Api\V1;

class KeywordAction extends Response
{
    protected $columns = [
        'id'                                => 0,
        'keyword_id'                        => 0,
        'action_id'                         => 0,
        'parameters'                        => '',
    ];

    /**
     * @param \App\Models\KeywordAction $model
     *
     * @return static
     */
    public static function updateWithModel($model)
    {
        $response = new static([], 400);
        if (!empty($model)) {
            $modelArray = [
                'id'                                => $model->id,
                'keyword_id'                        => $model->keyword_id,
                'action_id'                         => $model->action_id,
                'parameters'                        => $model->parameters,
            ];
            $response = new static($modelArray, 200);
        }

        return $response;
    }
}
