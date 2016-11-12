<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Hash;

class Account extends Authenticatable
{
    use Notifiable;

    protected $table = 'accounts';

    public function players()
    {
        return $this->hasMany('App\Player');
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
    'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
    'password', 'remember_token',
    ];

    //Hash sha1 password on create
    public function setPasswordAttribute($value) {
        $this->attributes['password'] = Hash::make($value);
    }


}
