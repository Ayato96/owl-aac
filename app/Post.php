<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
	protected $table = 'posts';

	public function player()
	{
		return $this->belongsTo('App\Player', 'player_id');
	}

	protected $fillable = 
	[
	'player_id', 'title', 'content'
	];
}
