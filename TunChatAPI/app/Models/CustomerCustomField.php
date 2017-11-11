<?php

namespace App\Models;

use LaravelRocket\Foundation\Models\Base;



/**
 * App\Models\CustomerCustomField.
 *
 * @method \App\Presenters\CustomerCustomFieldPresenter present()
 *
 */

class CustomerCustomField extends Base
{

    
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'customer_custom_fields';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'page_id',
        'field',
        'type',
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

    protected $presenter = \App\Presenters\CustomerCustomFieldPresenter::class;

    // Relations
        public function page()
    {
        return $this->belongsTo(\App\Models\Page::class, 'page_id', 'id');
    }



    // Utility Functions

}
