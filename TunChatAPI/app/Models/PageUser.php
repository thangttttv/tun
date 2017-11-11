<?php

namespace App\Models;

use LaravelRocket\Foundation\Models\Base;



/**
 * App\Models\PageUser.
 *
 * @method \App\Presenters\PageUserPresenter present()
 *
 */

class PageUser extends Base
{

    
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'page_users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'page_id',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];

    protected $dates  = [];

    protected $presenter = \App\Presenters\PageUserPresenter::class;

    // Relations
        public function user()
    {
        return $this->belongsTo(\App\Models\User::class, 'user_id', 'id');
    }

    public function page()
    {
        return $this->belongsTo(\App\Models\Page::class, 'page_id', 'id');
    }



    // Utility Functions

}
