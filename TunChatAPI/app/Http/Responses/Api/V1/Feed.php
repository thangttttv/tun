<?php
/**
 * Created by PhpStorm.
 * User: ThangTT
 * Date: 09/11/2017
 * Time: 10:18 SA.
 */
namespace App\Http\Responses\Api\V1;

use Carbon\Carbon;

class Feed extends Response
{
    protected $columns = [
        'id'                                     => 0,
        'page_id'                                => 0,
        'feed_facebook_id'                       => '',
        'message'                                => '',
        'description'                            => '',
        'picture'                                => '',
        'full_picture'                           => '',
        'caption'                                => '',
        'admin_creator_name'                     => '',
        'admin_creator_id'                       => '',
        'created_time'                           => 0,
        'link'                                   => 0,
        'from_name'                              => '',
        'from_id'                                => 0,
        'is_hidden'                              => 0,
        'is_published'                           => 0,
        'is_popular'                             => 0,
        'is_expired'                             => 0,
        'is_spherical'                           => 0,
        'subscribed'                             => 0,
    ];

    /**
     * @param \App\Models\Feed $model
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
	            'feed_facebook_id'                       => $model->feed_facebook_id,
	            'message'                                => $model->message,
	            'description'                            => $model->description,
	            'picture'                                => $model->picture,
	            'full_picture'                           => $model->full_picture,
	            'caption'                                => $model->caption,
	            'admin_creator_name'                     => $model->admin_creator_name,
	            'admin_creator_id'                       => $model->admin_creator_id,
	            'created_time'                           => (new Carbon($model->created_time))->timestamp,
	            'link'                                   => $model->link,
	            'from_name'                              => $model->from_name,
	            'from_id'                                => $model->from_id,
	            'is_hidden'                              => $model->is_hidden,
	            'is_published'                           => $model->is_published,
	            'is_popular'                             => $model->is_popular,
	            'is_expired'                             => $model->is_expired,
	            'is_spherical'                           => $model->is_spherical,
	            'subscribed'                             => $model->subscribed,
            ];

            $response = new static($modelArray, 200);
        }

        return $response;
    }
}
