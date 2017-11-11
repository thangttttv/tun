<?php
/**
 * Created by PhpStorm.
 * User: ThangTT
 * Date: 11/11/2017
 * Time: 1:41 SA.
 */
namespace App\Http\Responses\Api\V1;

class Tag extends Response
{
    protected $columns = [
        'id'                      => 0,
        'tag'                     => '',
        'page_id'                 => '',
        'matched'                 => '',

    ];

    /**
     * @param \App\Models\Tag $model
     *
     * @return static
     */
    public static function updateWithModel($model)
    {
        $response = new static([], 400);
        if (!empty($model)) {
            $modelArray = [
                'id'                      => $model->id,
                'tag'                     => $model->tag,
                'page_id'                 => $model->page_id,
                'matched'                 => $model->matched,
            ];
            $response = new static($modelArray, 200);
        }

        return $response;
    }
}
