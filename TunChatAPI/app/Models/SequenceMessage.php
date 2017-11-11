<?php

namespace App\Models;

use LaravelRocket\Foundation\Models\Base;



/**
 * App\Models\SequenceMessage.
 *
 * @method \App\Presenters\SequenceMessagePresenter present()
 *
 */

class SequenceMessage extends Base
{

    
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'sequence_messages';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'sequence_id',
        'message_id',
        'sent_after_day',
        'send',
        'opened',
        'clicked',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];

    protected $dates  = [];

    protected $presenter = \App\Presenters\SequenceMessagePresenter::class;

    // Relations
        public function sequence()
    {
        return $this->belongsTo(\App\Models\Sequence::class, 'sequence_id', 'id');
    }

    public function message()
    {
        return $this->belongsTo(\App\Models\Message::class, 'message_id', 'id');
    }



    // Utility Functions

}
