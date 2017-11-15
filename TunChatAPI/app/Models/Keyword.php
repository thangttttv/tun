<?php

namespace App\Models;

use LaravelRocket\Foundation\Models\Base;



/**
 * App\Models\Keyword.
 *
 * @method \App\Presenters\KeywordPresenter present()
 *
 */

class Keyword extends Base
{

    
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'keywords';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'page_id',
	    'title',
        'keyword_only',
        'keyword_in',
        'keyword_a_and_b',
        'keyword_a_not_b',
        'message_id',
	    'keyword_only_status',
	    'keyword_in_status',
	    'keyword_a_and_b_status',
	    'keyword_a_not_b_status',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];

    protected $dates  = [];

    protected $presenter = \App\Presenters\KeywordPresenter::class;

    // Relations
        public function page()
    {
        return $this->belongsTo(\App\Models\Page::class, 'page_id', 'id');
    }

    public function messageReply()
    {
        return $this->belongsTo(\App\Models\Message::class, 'message_id', 'id');
    }

    // Utility Functions

}
