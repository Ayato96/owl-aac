<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Hash;

class Account extends Authenticatable
{
    use Notifiable;

    protected $table = 'accounts';

    protected $casts = [
    'is_admin' => 'boolean',
    ];

    protected $fillable = [
    'name', 'email', 'password',
    ];

    protected $hidden = [
    'password', 'remember_token',
    ];

    protected $guarded = ['is_admin', 'salt', 'premdays', 'lastday', 'key', 'blocked', 'warnings', 'group_id'];

    public function isAdmin()
    {
        return $this->is_admin;
    }
    
    //Hash sha1 password on create
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = Hash::make($value);
    }

    public function players()
    {
        return $this->hasMany('App\Player');
    }

}
