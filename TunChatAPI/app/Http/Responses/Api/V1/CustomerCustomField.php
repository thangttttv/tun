<?php
/**
 * Created by PhpStorm.
 * User: ThangTT
 * Date: 10/11/2017
 * Time: 2:41 CH.
 */
namespace App\Http\Responses\Api\V1;

class CustomerCustomField extends Response
{
    protected $columns = [
        'id'                                     => 0,
        'page_id'                                => 0,
        'field'                                  => '',
        'type'                                   => '',
        'description'                            => '',
        'status'                                 => 0,
    ];

    /**
     * @param \App\Models\CustomerCustomField $model
     *
     * @return static
     */
    public static function updateWithModel($model)
    {
        $response = new static([], 400);

        if (!empty($model)) {
            $modelArray = [
                'id'                                     => $model->id,
                'page_id'                                => $model->page_id,
                'field'                                  => $model->field,
                'type'                                   => $model->type,
                'description'                            => $model->description,
                'status'                                 => $model->status,
            ];

            $response = new static($modelArray, 200);
        }

        return $response;
    }
}
