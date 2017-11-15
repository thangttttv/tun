<?php

namespace App\Models;

use LaravelRocket\Foundation\Models\Base;



/**
 * App\Models\Action.
 *
 * @method \App\Presenters\ActionPresenter present()
 *
 */

class Action extends Base
{

    
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'actions';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'code',
	    'title',
        'description',
        'status',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];

    protected $dates  = [];

    protected $presenter = \App\Presenters\ActionPresenter::class;

    // Relations
    

    // Utility Functions

}
