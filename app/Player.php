<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

use Thetispro\Setting\Facades\Setting;

/**
 * Class Player
 * @package App
 */
class Player extends Model
{
    use SoftDeletes;

    /**
     * @var string
     */
    protected $table = 'players';

    /**
     * For deletion column works in laravel and otx/tfs
     * @var string
     */
    protected $dateFormat = 'U';

    /**
     * @var array
     */
    protected $dates = [
        'created_at',
        'updated_at',
        'deletion',
    ];

    /**
     * @var string
     */
    const DELETED_AT = 'deletion';

    /**
     * @var array
     */
    protected $attributes = array(
        'experience' => 4200,
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

    /**
     * @var array
     */
    protected $fillable = [
        'name', 'account_id', 'vocation', 'sex', 'town_id'
    ];

    /**
     * @var array
     */
    protected $guarded = [
        'world_id', 'group_id', 'level', 'health', 'healthmax', 'experience', 'lookbody', 'lookfeet',
        'lookhead', 'looklegs', 'looktype', 'lookaddons', 'lookmount', 'maglevel', 'mana', 'manamax',
        'manaspent', 'soul', 'posx', 'posy', 'posz', 'conditions', 'cap', 'lastlogin', 'lastip', 'save',
        'skull', 'skulltime', 'rank_id', 'guildnick', 'lastlogout', 'blessings', 'pvp_blessing',
        'balance', 'stamina', 'direction', 'loss_experience', 'loss_mana', 'loss_skills',
        'loss_containers', 'loss_items', 'premend', 'online', '	marriage', 'promotion', 'deletion',
        'description',
    ];


    /*
    * RELATIONSHIPS
    */
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function account()
    {
        return $this->belongsTo('App\Account', 'account_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function membership()
    {
        return $this->hasOne('App\GuildMembership');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function rank()
    {
        return $this->belongsToMany('App\GuildRank', 'guild_membership', 'player_id', 'rank_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function posts()
    {
        return $this->hasMany('App\Post');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function deaths()
    {
        return $this->hasMany('App\PlayerDeath');
    }

    /*
    * GETS AND SETTERS
    */

    /**
     * @param $value
     * @return string
     */
    public function getOnlineAttribute($value)
    {
        if ($value == 0) {
            return 'Offline';
        } else {
            return 'Online';
        }
    }

    /**
     * @param $value
     * @return mixed
     */
    public function getVocationAttribute($value)
    {
        foreach (Setting::get('Server.Vocations') as $vocation) {
            if ($value == $vocation['id']) return $vocation['name'];
        }
    }

    /**
     * @param $value
     * @return string
     */
    public function getMarriageAttribute($value)
    {
        return 'single';
    }

    /**
     * @param $value
     * @return string
     */
    public function getSexAttribute($value)
    {
        return 'male';
    }

    /**
     * @param $value
     * @return mixed
     */
    public function getWorldIdAttribute($value)
    {
        foreach (Setting::get('Server.Worlds') as $world) {
            if ($value == $world['id']) return $world['name'];
        }
    }

    /**
     * @param $value
     * @return string
     */
    public function getLastloginAttribute($value)
    {
        if ($value == 0) {
            return 'Never loggedin';
        } else {
            return Carbon::createFromTimestamp($value)->diffForHumans();
        }

    }

    /**
     * @return mixed
     */
    public function getTown()
    {
        foreach (Setting::get('Server.Towns') as $town) {
            if ($this->attributes['town_id'] == $town['id']) return $town['name'];
        }
    }

    /**
     * @return mixed
     */
    public function getPlayerList()
    {
        return $this->account->players;
    }

    /**
     * @return string
     */
    public function getPremiumStatus()
    {

        return ($this->account->premdays > 0 ? 'Premium Account' : 'Free Account');
    }

    /**
     * @return mixed
     */
    public function getGuild()
    {
        if (isset($this->membership)) {
            return $this->membership->guild->name;
        } else {
            return false;
        }
    }

    /**
     * @return mixed
     */
    public function getRank()
    {
        return $this->rank->first();
    }

    /**
     * @param $value
     */
    public function setNameAttribute($value)
    {
        $this->attributes['name'] = ucwords(strtolower($value));
    }

}
