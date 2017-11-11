<?php

namespace App\Models;

use LaravelRocket\Foundation\Models\Base;



/**
 * App\Models\SequenceCustomer.
 *
 * @method \App\Presenters\SequenceCustomerPresenter present()
 *
 */

class SequenceCustomer extends Base
{

    
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'sequence_customers';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'sequence_id',
        'customer_id',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];

    protected $dates  = [];

    protected $presenter = \App\Presenters\SequenceCustomerPresenter::class;

    // Relations
        public function sequence()
    {
        return $this->belongsTo(\App\Models\Sequence::class, 'sequence_id', 'id');
    }

    public function customer()
    {
        return $this->belongsTo(\App\Models\Customer::class, 'customer_id', 'id');
    }



    // Utility Functions

}
