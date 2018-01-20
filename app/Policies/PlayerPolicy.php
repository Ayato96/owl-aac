<?php

namespace App\Policies;

use App\Account;
use App\Player;
use Illuminate\Auth\Access\HandlesAuthorization;

/**
 * Class PlayerPolicy
 * @package App\Policies
 */
class PlayerPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the Account can view the player.
     *
     * @param Account $account
     * @param  Player $player
     * @return mixed
     */
    public function view(Account $account, Player $player)
    {
        //
    }

    /**
     * Determine whether the Account can create players.
     *
     * @param Account $account
     * @return mixed
     */
    public function create(Account $account)
    {
        //
    }

    /**
     * Determine whether the Account can update the player.
     *
     * @param Account $account
     * @param  Player $player
     * @return mixed
     */
    public function update(Account $account, Player $player)
    {
        return $account->id === $player->account_id;
    }

    /**
     * Determine whether the Account can delete the player.
     *
     * @param Account $account
     * @param  Player $player
     * @return mixed
     */
    public function delete(Account $account, Player $player)
    {
        return $account->id === $player->account_id;
    }

    /**
     * Determine whether the Account can restore     the player.
     * @param Account $account
     * @param Player $player
     * @return bool
     */
    public function restore(Account $account, Player $player)
    {
        return $account->id === $player->account_id;
    }


}
