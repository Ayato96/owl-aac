<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class GuildMembership
 * @package App
 */
class GuildMembership extends Model
{
    /**
     * @var string
     */
    protected $table = 'guild_membership';

    public $timestamps = false;

    protected $fillable = [
        'player_id',
        'rank_id',
    ];
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function guild()
    {
        return $this->belongsTo('App\Guild');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function player()
    {
        return $this->belongsTo('App\Player');
    }
}
