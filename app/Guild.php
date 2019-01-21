<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

/**
 * Class Guild
 * @package App
 */
class Guild extends Model
{
    /**
     * @var string
     */
    protected $table = 'guilds';

    /**
     * @var string
     */

    const CREATED_AT = 'creationdata';
    /**
     * @var string
     */

    const UPDATED_AT = null;
    /**
     * @var array
     */

    protected $fillable = [
        'name', 'ownerid', 'motd'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function players()
    {
        return $this->belongsToMany('App\Player', 'guild_membership', 'guild_id', 'player_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function rank()
    {
        return $this->belongsToMany('App\GuildRank', 'guild_membership', 'guild_id', 'rank_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function ranks()
    {
        return $this->hasMany('App\GuildRank');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function invites()
    {
        return $this->belongsToMany('App\Player', 'guild_invites', 'guild_id', 'player_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function members()
    {
        return $this->belongsToMany('App\GuildMembership', 'players', 'guild_id', 'player_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function owner()
    {
        return $this->belongsTo('App\Player', 'ownerid');
    }


    /**
     * @param $value
     */
    public function setCreationdataAttribute($value)
    {
        $this->attributes['creationdata'] = \Carbon\Carbon::now()->timestamp;
    }

    /**
     * @param $value
     * @return string
     */
    public function getCreationdataAttribute($value)
    {
        $data = Carbon::createFromTimestamp($value)->toDateString();
        return $data;
    }

}
