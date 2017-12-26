<?php

namespace App\Models;

use LaravelRocket\Foundation\Models\Base;



/**
 * App\Models\MessageItem.
 *
 * @method \App\Presenters\MessageItemPresenter present()
 *
 */

class MessageItem extends Base
{

    
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'message_items';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'message_id',
	    'type',
        'message',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];

    protected $dates  = [];

    protected $presenter = \App\Presenters\MessageItemPresenter::class;

    // Relations
        public function message()
    {
        return $this->belongsTo(\App\Models\Message::class, 'message_id', 'id');
    }



    // Utility Functions

}
