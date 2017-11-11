<?php

namespace App\Models;

use LaravelRocket\Foundation\Models\Base;



/**
 * App\Models\Tag.
 *
 * @method \App\Presenters\TagPresenter present()
 *
 */

class Tag extends Base
{

    
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'tags';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'page_id',
        'tag',
        'matched',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];

    protected $dates  = [];

    protected $presenter = \App\Presenters\TagPresenter::class;

    // Relations
        public function page()
    {
        return $this->belongsTo(\App\Models\Page::class, 'page_id', 'id');
    }



    // Utility Functions

}
