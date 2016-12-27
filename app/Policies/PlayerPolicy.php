<?php

namespace App\Policies;

use App\Account;
use App\Player;
use Illuminate\Auth\Access\HandlesAuthorization;

class PlayerPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the Account can view the player.
     *
     * @param  \App\Account  $Account
     * @param  \App\Player  $player
     * @return mixed
     */
    public function view(Account $account, Player $player)
    {
        //
    }

    /**
     * Determine whether the Account can create players.
     *
     * @param  \App\Account  $Account
     * @return mixed
     */
    public function create(Account $account)
    {
        //
    }

    /**
     * Determine whether the Account can update the player.
     *
     * @param  \App\Account  $Account
     * @param  \App\Player  $player
     * @return mixed
     */
    public function update(Account $account, Player $player)
    {
        return $account->id === $player->account_id;
    }

    /**
     * Determine whether the Account can delete the player.
     *
     * @param  \App\Account  $Account
     * @param  \App\Player  $player
     * @return mixed
     */
    public function delete(Account $account, Player $player)
    {
        //
    }
}
