<?php
namespace App\Models;

use LaravelRocket\Foundation\Models\Base;

/**
 * App\Models\OauthRefreshToken.
 *
 * @method \App\Presenters\OauthRefreshTokenPresenter present()
 *
 * @property int $id
 * @property string $access_token_id
 * @property bool $revoked
 * @property \Carbon\Carbon $expires_at
 * @property-read \App\Models\OauthAccessToken $accessToken
 *
 * @method static \Illuminate\Database\Query\Builder|\App\Models\OauthRefreshToken whereAccessTokenId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\OauthRefreshToken whereExpiresAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\OauthRefreshToken whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\OauthRefreshToken whereRevoked($value)
 * @mixin \Eloquent
 */
class OauthRefreshToken extends Base
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'oauth_refresh_tokens';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'access_token_id',
        'revoked',
        'expires_at',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden    = [];

    protected $dates     = ['expires_at'];

    protected $presenter = \App\Presenters\OauthRefreshTokenPresenter::class;

    // Relations
    public function accessToken()
    {
        return $this->belongsTo(\App\Models\OauthAccessToken::class, 'access_token_id', 'id');
    }

    // Utility Functions
}
