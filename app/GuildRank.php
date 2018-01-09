<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GuildRank extends Model
{
    protected $table = 'guild_ranks';

    /*
    * RELATIONSHIPS
    */
   
    public function players()
    {
       return $this->belongsToMany('App\Player', 'guild_membership', 'rank_id', 'player_id');
    }

    public function guild()
    {
       return $this->belongsToMany('App\Guild', 'guild_membership', 'rank_id', 'guild_id');
    }
}
