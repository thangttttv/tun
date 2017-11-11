<?php
/**
 * Created by PhpStorm.
 * User: ThangTT
 * Date: 08/11/2017
 * Time: 5:31 CH.
 */
namespace App\Http\Responses\Api\V1;

class Customer extends Response
{
    protected $columns = [
        'id'                               => 0,
        'page_id'                          => 0,
        'facebook_id'                      => '',
        'name'                             => '',
        'email'                            => '',
        'mobile'                           => '',
        'gender'                           => '',
        'opted_in_through'                 => '',
        'time_subscribed'                  => '',
        'avatar_url'                       => '',
        'subscribed'                       => 0,
        'can_reply'                        => 0,
        'country'                          => '',
        'address'                          => '',

    ];

    /**
     * @param \App\Models\Customer $model
     *
     * @return static
     */
    public static function updateWithModel($model)
    {
        $response = new static([], 400);
        if (!empty($model)) {
            $modelArray = [
	            'id'                               => $model->id,
	            'page_id'                          => $model->page_id,
	            'facebook_id'                      => $model->facebook_id,
	            'name'                             => $model->name,
	            'email'                            => $model->email,
	            'mobile'                           => $model->mobile,
	            'gender'                           => $model->gender,
	            'opted_in_through'                 => $model->opted_in_through,
	            'time_subscribed'                  => $model->time_subscribed,
	            'avatar_url'                       => $model->avatar_url,
	            'subscribed'                       => $model->subscribed,
	            'can_reply'                        => $model->can_reply,
	            'country'                          => $model->country,
	            'address'                          => $model->address,
            ];

            $response = new static($modelArray, 200);
        }

        return $response;
    }
}
