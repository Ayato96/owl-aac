<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Killer extends Model
{
	protected $table = 'killers';

	public function monsters()
    {
        return $this->hasMany('App\EnvironmentKiller', 'kill_id');
    }

    public function players()
    {
        return $this->belongsToMany('App\Player', 'player_killers', 'kill_id', 'player_id');
    }
}
