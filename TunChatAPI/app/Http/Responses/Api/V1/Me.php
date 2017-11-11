<?php
namespace App\Http\Responses\Api\V1;

class Me extends Response
{
    protected $columns = [
        'id'           => 0,
        'name'         => '',
        'email'        => '',
        'phoneNumber'  => '',
        'profileImage' => [],
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
                'id'           => $model->id,
                'name'         => $model->name,
                'email'        => $model->email,
                'phoneNumber'  => $model->phone_number,
                'profileImage' => $model->profileImage,
            ];
            $response = new static($modelArray, 200);
        }

        return $response;
    }
}
