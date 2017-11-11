<?php
namespace App\Models;

/**
 * App\Models\UserServiceAuthentication.
 *
 * @method \App\Presenters\UserServiceAuthenticationPresenter present()
 *
 * @property int $id
 * @property int $user_id
 * @property string $name
 * @property string $email
 * @property string $service service name , facebook, google ...
 * @property string $service_id service user id. It must be string
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \App\Models\User $user
 *
 * @method static \Illuminate\Database\Query\Builder|\App\Models\UserServiceAuthentication whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\UserServiceAuthentication whereEmail($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\UserServiceAuthentication whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\UserServiceAuthentication whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\UserServiceAuthentication whereService($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\UserServiceAuthentication whereServiceId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\UserServiceAuthentication whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\UserServiceAuthentication whereUserId($value)
 * @mixin \Eloquent
 */
class UserServiceAuthentication extends ServiceAuthenticationBase
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'user_service_authentications';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'name',
        'email',
        'service',
        'service_id',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden    = [];

    protected $dates     = [];

    protected $presenter = \App\Presenters\UserServiceAuthenticationPresenter::class;

    // Relations
    public function user()
    {
        return $this->belongsTo(\App\Models\User::class, 'user_id', 'id');
    }

    // Utility Functions
}
