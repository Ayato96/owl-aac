<?php

namespace App\Http\Middleware;

use Closure;

/**
 * Class CheckGuild
 * @package App\Http\Middleware
 */
class CheckGuild
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $levelCheck = 0;
        $players = \App\Account::loggedin()->players()->get();
        foreach ($players as $player) {
            if ($player->getRank()) {
                if ($player->getRank()->level == 3) {
                    flash('Do you already have a guild?')->error()->important();
                    return redirect()->route('account.index');
                }
            }
            if ($levelCheck < $player->level) {
                $levelCheck = $player->level;
            }
        }
        if ($levelCheck < env('OWL_GUILD_LEVEL')) {
            flash('character level not enough.')->error()->important();
            return redirect()->route('account.index');
        }
        return $next($request);
    }
}
