<?php
/**
 * Created by PhpStorm.
 * User: ThangTT
 * Date: 05/11/2017
 * Time: 12:39 SA.
 */
namespace App\Http\Responses\Api\V1;

class Account extends Response
{
    protected $columns = [
        'id'                      => 0,
        'name'                    => '',
        'country'                 => '',

    ];

    /**
     * @param \App\Models\User $model
     *
     * @return static
     */
    public static function updateWithModel($model)
    {
        $response = new static([], 400);
        if (!empty($model)) {
            $modelArray = [
                'id'                         => $model->id,
                'name'                       => $model->name,
                'country'                    => $model->country,
            ];
            $response = new static($modelArray, 200);
        }

        return $response;
    }
}
