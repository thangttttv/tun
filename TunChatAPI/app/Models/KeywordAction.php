<?php

namespace App\Models;

use LaravelRocket\Foundation\Models\Base;



/**
 * App\Models\KeywordAction.
 *
 * @method \App\Presenters\KeywordActionPresenter present()
 *
 */

class KeywordAction extends Base
{

    
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'keyword_actions';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'keyword_id',
        'action_id',
        'parameters',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];

    protected $dates  = [];

    protected $presenter = \App\Presenters\KeywordActionPresenter::class;

    // Relations
        public function keyword()
    {
        return $this->belongsTo(\App\Models\Keyword::class, 'keyword_id', 'id');
    }

    public function action()
    {
        return $this->belongsTo(\App\Models\Action::class, 'action_id', 'id');
    }



    // Utility Functions

}
