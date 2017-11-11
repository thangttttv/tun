<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use LaravelRocket\Foundation\Models\AuthenticatableBase;



/**
 * App\Models\User.
 *
 * @method \App\Presenters\UserPresenter present()
 *
 */

class User extends AuthenticatableBase
{

	use HasApiTokens, Notifiable;
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'account_id',
        'facebook_id',
        'email',
        'full_name',
        'avatar',
        'mobile',
        'is_owner',
	    'password',
        'remember_token',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];

    protected $dates  = [];

    protected $presenter = \App\Presenters\UserPresenter::class;

    // Relations
        public function account()
    {
        return $this->belongsTo(\App\Models\Account::class, 'account_id', 'id');
    }

    // Utility Functions

}
