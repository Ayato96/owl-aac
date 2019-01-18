<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Hash;
use Auth;

/**
 * Class Account
 * @package App
 */
class Account extends Authenticatable
{
    use Notifiable;

    /**
     * @var string
     */
    protected $table = 'accounts';

    /**
     * @var array
     */
    protected $casts = [
        'is_admin' => 'boolean',
    ];

    /**
     * @var array
     */
    protected $attributes = array(
        'vote' => 0,
        'vip_time' => 0,
        'birth_date' => '',
        'gender' => '',
        'authToken' => '',
    );

    /**
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'key',
    ];

    /**
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'key',
    ];

    /**
     * @var array
     */
    protected $guarded = [
        'is_admin', 'salt', 'premdays', 'lastday', 'blocked', 'warnings', 'group_id'
    ];

    /**
     * @return boolean
     */
    public function isAdmin()
    {
        return $this->is_admin;
    }

    /**
     * @param $value
     */
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = Hash::make($value);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function players()
    {
        return $this->hasMany('App\Player');
    }

    public function playersWithTrash()
    {
        return $this->hasMany('App\Player')->withTrashed();
    }

    public function playersOnlyTrash()
    {
        return $this->hasMany('App\Player')->onlyTrashed();
    }

    /**
     * @return mixed
     */
    public static function loggedin()
    {
        return Auth::user();
    }

}
