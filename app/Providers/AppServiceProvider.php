<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Exception;
use Thetispro\Setting\Facades\Setting;

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
                ['group_id',1],
                ['account_id','>',1]
                ])
            ->orderBy('level','desc')
            ->limit(5)
            ->get();
            $view->with('playerRank', $playerRank);
        });


        /*
         *  #VALIDATIONS
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

        Validator::extend('character_name', function($attribute, $value, $parameters)
        {
            // contains 
            $temp = strspn($value, "qwertyuiopasdfghjklzxcvbnmQWERTYUIOPASDFGHJKLZXCVBNM "); // letters accepteds
            if($temp != strlen($value)) return false;

            // 3 letters consecutives
            for($i = 0; $i < strlen($value); $i++){
                if(substr($value, $i, 1) == substr($value, $i+1, 1) && substr($value, $i, 1) == substr($value, $i+2, 1))
                    return false;
            }
                
            //spaces
            for($i = 0; $i < strlen($value); $i++)
            {
                if(substr($value, $i-1, 1) == ' ' && substr($value, $i+1, 1) == ' ') 
                    return false;
            }

            if(substr($value, 1, 1) == ' ') return false;
            if(substr($value, -2, 1) == " ") return false;
            if(substr($value, 0, 1) == " ") return false;

            foreach(Setting::get('Server.Monsters') as $monsterNames)
            {
                if ($value == $monsterNames) return false;
            }

            return true;
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
