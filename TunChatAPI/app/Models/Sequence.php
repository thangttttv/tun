<?php

namespace App\Models;

use LaravelRocket\Foundation\Models\Base;



/**
 * App\Models\Sequence.
 *
 * @method \App\Presenters\SequencePresenter present()
 *
 */

class Sequence extends Base
{

    
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'sequences';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'page_id',
        'title',
        'sent_date',
        'sent_time_from',
        'sent_time_to',
        'embedded',
        'message',
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

    protected $presenter = \App\Presenters\SequencePresenter::class;

    // Relations
        public function page()
    {
        return $this->belongsTo(\App\Models\Page::class, 'page_id', 'id');
    }



    // Utility Functions

}
