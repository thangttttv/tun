<?php

namespace App\Models;

use LaravelRocket\Foundation\Models\Base;



/**
 * App\Models\Customer.
 *
 * @method \App\Presenters\CustomerPresenter present()
 *
 */

class Customer extends Base
{

    
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'customers';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'facebook_id',
	    'page_id',
        'name',
        'email',
        'mobile',
        'gender',
        'opted_in_through',
        'time_subscribed',
        'avatar_url',
        'subscribed',
        'can_reply',
        'country',
        'address',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];

    protected $dates  = ['time_subscribed'];

    protected $presenter = \App\Presenters\CustomerPresenter::class;

    // Relations
        public function facebook()
    {
        return $this->belongsTo(\App\Models\Page::class, 'page_id', 'id');
    }



    // Utility Functions

}
