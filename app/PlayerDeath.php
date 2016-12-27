<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class PlayerDeath extends Model
{
	protected $table = 'player_deaths';

	public function player()
	{
		return $this->belongsTo('App\Player');
	}

	public function killers()
    {
        return $this->hasMany('App\Killer', 'death_id');
    }

	public function getDateAttribute($value)
	{
		return Carbon::createFromTimestamp($value)->toDateTimeString();
	}

}
