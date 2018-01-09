<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Guild extends Model
{
    protected $table = 'guilds';

    /*
    * RELATIONSHIPS
    */
   
    public function players()
    {
       return $this->belongsToMany('App\Player', 'guild_membership', 'guild_id', 'player_id');
    }

    public function rank()
    {
       return $this->belongsToMany('App\GuildRank', 'guild_membership', 'guild_id', 'rank_id');
    }

    public function invites()
    {
       return $this->belongsToMany('App\Player', 'guild_invites', 'guild_id', 'player_id');
    }

    public function owner()
    {
       return $this->belongsTo('App\Player', 'ownerid');
    }

    /*
    * GETS AND SETTERS
    */
   
    public function getCreationdataAttribute($value)
    {
        $data = Carbon::createFromTimestamp($value)->toDateString();
        return $data;
    }

}
