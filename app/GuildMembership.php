<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GuildMembership extends Model
{
    protected $table = 'guild_membership';

    /*
    * RELATIONSHIPS
    */
   
    public function guild()
    {
       return $this->belongsTo('App\Guild');
    }

    public function player()
    {
       return $this->belongsTo('App\Player');
    }
}
