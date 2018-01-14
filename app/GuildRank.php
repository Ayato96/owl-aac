<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class GuildRank
 * @package App
 */
class GuildRank extends Model
{
    /**
     * @var string
     */
    protected $table = 'guild_ranks';

    /**
     * @var array
     */
    protected $hidden = ['pivot'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function players()
    {
        return $this->belongsToMany('App\Player', 'guild_membership', 'rank_id', 'player_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function guild()
    {
        return $this->belongsToMany('App\Guild', 'guild_membership', 'rank_id', 'guild_id');
    }
}
