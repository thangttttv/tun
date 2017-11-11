<?php

namespace App\Models;

use LaravelRocket\Foundation\Models\Base;



/**
 * App\Models\TagCustomer.
 *
 * @method \App\Presenters\TagCustomerPresenter present()
 *
 */

class TagCustomer extends Base
{

    
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'tag_customers';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'tag_id',
        'customer_id',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];

    protected $dates  = [];

    protected $presenter = \App\Presenters\TagCustomerPresenter::class;

    // Relations
        public function tag()
    {
        return $this->belongsTo(\App\Models\Tag::class, 'tag_id', 'id');
    }

    public function customer()
    {
        return $this->belongsTo(\App\Models\Customer::class, 'customer_id', 'id');
    }



    // Utility Functions

}
