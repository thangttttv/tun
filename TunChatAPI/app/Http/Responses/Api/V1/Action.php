<?php
/**
 * Created by PhpStorm.
 * User: ThangTT
 * Date: 15/11/2017
 * Time: 4:13 CH.
 */
namespace App\Http\Responses\Api\V1;

class Action extends Response
{
    protected $columns = [
        'id'                          => 0,
        'code'                        => '',
        'title'                       => '',
        'description'                 => '',
    ];

    /**
     * @param \App\Models\Action $model
     *
     * @return static
     */
    public static function updateWithModel($model)
    {
        $response = new static([], 400);
        if (!empty($model)) {
            $modelArray = [
                'id'                          => $model->id,
                'code'                        => $model->code,
                'title'                       => $model->title,
                'description'                 => $model->description,
            ];
            $response = new static($modelArray, 200);
        }

        return $response;
    }
}
