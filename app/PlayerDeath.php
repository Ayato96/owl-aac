<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class PlayerDeath extends Model
{
	protected $table = 'player_deaths';
    protected $casts = [
        'is_player' => 'boolean',
        'mostdamage_is_player' => 'boolean',
        'unjustified' => 'boolean',
    ];

	public function player()
	{
		return $this->belongsTo('App\Player');
	}

	public function getTimeAttribute($value)
	{
		return Carbon::createFromTimestamp($value)->toDateTimeString();
	}

}
