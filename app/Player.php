<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

use Thetispro\Setting\Facades\Setting;

class Player extends Model
{
	protected $table = 'players';
	
	protected $attributes = array(
		'experience'  => 4200,
		'conditions' => '',
		'level' => 8,
		'mana' => 35,
		'manamax' => 35,
		'health' => 185,
		'healthmax' => 185,
		'soul' => 100,
		'balance' => 0,
		'group_id' => 1,
		'cap' => 450,
		);

	protected $fillable = [
	'name', 'account_id', 'vocation', 'sex', 'town_id'
	];

	protected $guarded = [
	'world_id', 'group_id', 'level', 'health', 'healthmax', 'experience', 'lookbody', 'lookfeet', 'lookhead',
	'looklegs', 'looktype', 'lookaddons', 'lookmount', 'maglevel', 'mana', 'manamax', 'manaspent', 'soul', 
	'posx', 'posy', 'posz', 'conditions', 'cap', 'lastlogin', '	lastip', 'save', 'skull', 'skulltime', 'rank_id',
	'guildnick', 'lastlogout', 'blessings', 'pvp_blessing', 'balance', 'stamina', 'direction', 'loss_experience', 
	'loss_mana', 'loss_skills', 'loss_containers', 'loss_items', 'premend', 'online', '	marriage', 'promotion', 
	'deleted', 'description', 
	];

	protected $dates = [
	'created_at',
	'updated_at',
	];

	/*
	* RELATIONSHIPS
	*/
	public function account()
	{
		return $this->belongsTo('App\Account', 'account_id');
	}

	public function posts()
	{
		return $this->hasMany('App\Post');
	}

	public function deaths()
	{
		return $this->hasMany('App\PlayerDeath');
	}
	
	/*
	* GETS AND SETTERS
	*/

	public function getOnlineAttribute($value)
	{
		if ($value==0)
		{
			return 'Offline';
		}
		else
		{
			return 'Online';	
		}
	}

	public function getVocationAttribute($value)
	{
		foreach(Setting::get('Server.Vocations') as $vocation)
		{
			if ($value == $vocation['id']) return $vocation['name'];
		}
	}

	public function getMarriageAttribute($value)
	{
		return 'single';
	}

	public function getSexAttribute($value)
	{
		return 'male';
	}

	public function getWorldIdAttribute($value)
	{
		foreach(Setting::get('Server.Worlds') as $world)
		{
			if ($value == $world['id']) return $world['name'];
		}
	}

	public function getTownIdAttribute($value)
	{
		foreach(Setting::get('Server.Towns') as $town)
		{
			if ($value == $town['id']) return $town['name'];
		}
	}

	public function getLastloginAttribute($value)
	{
		if ($value==0) {
			return 'Never loggedin';	
		}
		else
		{
			return Carbon::createFromTimestamp($value)->toDateTimeString();
		}
		
	}

	//slug character name
	public function setNameAttribute($value)
	{
		$this->attributes['name'] = ucwords($value);
		$this->attributes['slug'] = str_slug($value, '-');
	}
	
}
