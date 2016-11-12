<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Player extends Model
{
	public function user()
	{
		return $this->belongsTo('App\Account');
	}
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

	protected $fillable = 
	[
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

}
