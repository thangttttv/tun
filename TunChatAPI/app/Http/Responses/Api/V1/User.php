<?php
namespace App\Http\Responses\Api\V1;

class User extends Response
{
    protected $columns = [
        'id'                     => 0,
        'full_name'              => '',
        'avatar'                 => '',
        'mobile'                 => '',
        'email'                  => '',
        'facebook_id'            => '',
        'is_owner'               => 0,
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
                'facebookId'                 => $model->facebook_id,
                'fullName'                   => $model->full_name,
                'avatar'                     => $model->avatar,
                'mobile'                     => $model->mobile,
                'isOwner'                    => $model->is_owner,
                'email'                      => $model->email,
            ];
            $response = new static($modelArray, 200);
        }

        return $response;
    }
}
