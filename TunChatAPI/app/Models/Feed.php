<?php

namespace App\Models;

use LaravelRocket\Foundation\Models\Base;



/**
 * App\Models\Feed.
 *
 * @method \App\Presenters\FeedPresenter present()
 *
 */

class Feed extends Base
{

    
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'feeds';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'page_id',
        'feed_facebook_id',
        'message',
        'description',
        'picture',
        'full_picture',
        'caption',
        'admin_creator_name',
        'admin_creator_id',
        'created_time',
        'link',
        'from_name',
        'from_id',
        'is_hidden',
        'is_published',
        'is_popular',
        'is_expired',
        'is_spherical',
        'subscribed',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];

    protected $dates  = ['created_time'];

    protected $presenter = \App\Presenters\FeedPresenter::class;

    // Relations
        public function page()
    {
        return $this->belongsTo(\App\Models\Page::class, 'page_id', 'id');
    }

    // Utility Functions

}
