<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Exception;
use Thetispro\Setting\Facades\Setting;
use Hash;
use Auth;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('layouts.owl.app', function($view) {
            $playerRank = DB::table('players')
            ->where([
                ['group_id','<',4],
            ])
            ->orderBy('level','desc')
            ->limit(5)
            ->get();
            $view->with('playerRank', $playerRank);
        });

        /**
        * VALIDATIONS FOR CREATEPLAYER
        */

       /**
        * Banned words
        */
       Validator::extend('not_contains', function($attribute, $value, $parameters)
       {
        $words = array('fuck', 'caralho', 'fdp');
        foreach ($words as $word)
        {
            if (stripos($value, $word) !== false) return false;
        }
        return true;
    });

        /**
        * Rules for character name
        * Thx gesior
        */
        Validator::extend('character_name', function($attribute, $value, $parameters)
        {
            /**
             * Acceptable letters
             */
            $temp = strspn($value, "qwertyuiopasdfghjklzxcvbnmQWERTYUIOPASDFGHJKLZXCVBNM ");
            if($temp != strlen($value)) return false;

            /**
             * Verifies consecutive equal letters
             */
            for($i = 0; $i < strlen($value); $i++){
                if(substr($value, $i, 1) == substr($value, $i+1, 1) && substr($value, $i, 1) == substr($value, $i+2, 1))
                    return false;
            }

            /**
             * Verifies consecutive spaces
             */
            for($i = 0; $i < strlen($value); $i++)
            {
                if(substr($value, $i-1, 1) == ' ' && substr($value, $i+1, 1) == ' ')
                    return false;
            }

            if(substr($value, 1, 1) == ' ') return false;
            if(substr($value, -2, 1) == " ") return false;
            if(substr($value, 0, 1) == " ") return false;

            /**
             * checks to see if there is a monster with the same name
             */
            foreach(Setting::get('Server.Monsters') as $monsterName)
                {
                    if (strcasecmp($value, $monsterName)==0) return false;
                }
                return true;
            });

        /**
        * VALIDATIONS TO PASSWORD CHANGE
        */

        /**
        * Verifies that the password is equal to the current password
        */
        Validator::extend('old_password_check', function($attribute, $value, $parameters)
        {
            if(Hash::check($value, Auth::User()->password)) {
                return true;
            }
            return false;
        });

        /**
        * Verifies that the password is different to the current
        */
        Validator::extend('new_password_check', function($attribute, $value, $parameters)
        {
            if(!Hash::check($value, Auth::User()->password)) {
                return true;
            }
            return false;
        });

        /**
        * Verifies the character level for guild creation
        */
        Validator::extend('check_level', function($attribute, $value, $parameters)
        {
            $player = \App\Player::find($value);
            if($player->level >= env("OWL_GUILD_LEVEL")) {
                return true;
            }
            return false;
        });

        /**
        * Check if account own this character
        */
        Validator::extend('check_character_account', function($attribute, $value, $parameters)
        {
            $players = \App\Account::loggedin()->players()->get();
            foreach ($players as $player) {
                if ($player->id == $value) {
                    return true;
                }
            }
            return false;
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
