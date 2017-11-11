<?php

namespace App\Models;

use LaravelRocket\Foundation\Models\Base;



/**
 * App\Models\Page.
 *
 * @method \App\Presenters\PagePresenter present()
 *
 */

class Page extends Base
{

    
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'pages';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'facebook_id',
        'name',
        'access_token',
        'page_token',
        'category',
        'picture_url',
	    'subscribed'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];

    protected $dates  = [];

    protected $presenter = \App\Presenters\PagePresenter::class;

    // Relations

    // Utility Functions

}
