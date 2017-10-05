<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Account;

class ApiLoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('api');
    }

    /**
     * Authenticate accounts, list your players and send to client 11
     * @param  Request $request To get content of json
     * @return json    $data    Return the $data as json 
     */
    public function login(Request $request)
    {
        /**
         * VARIABLES
         * TODO: make an function to retrieve config.lua variables
         */
        $lastLogin=0;
        $ports = array(
            'game' => 7172,
            'cast' => 7173 // for future use 
        );
        
        /**
         * GET CONTENT OF GAME FORM
         */
        $requestJson = json_decode($request->getContent(), true);
        /*$requestJson['accountname'] = '123123'; // testing var
        $requestJson['password'] = '123123'; // testing var */

        /**
         * SELECT ACCOUNT 
         */
        $account = Account::where('name', $requestJson['accountname'])
            ->where('password', sha1($requestJson['password']))->first(); 

        /**
         * CHECK IF ACCOUNT AND PASSWORD MATCH
         */
        if (!$account) {
            $this->sendError("Wrong account or password. Try again!");
        }

        /**
         * SELECT PLAYERS FROM ACCOUNT
         */
        $players = $account->players;
        
        /**
         * FILL ARRAY WITH ALL CHARACTERS
         */
        foreach ($players as $player) {
            $characters[] = array(
                "worldid" => 0,
                "name" => $player->name,
                "ismale" => (($player->sex == 1) ? true : false),
                "tutorial" => false
            );

            if ($lastLogin < $player->lastlogin) {
                $lastLogin = $player->lastlogin;
            }
        }

        /**
         * FILL THE ARRAY FOR JSON RESPONSE
         * TODO: improve config.lua variables, free premium
         */
        $data = array(
            'session' => array(
                "sessionkey" => $requestJson['accountname'] . "\n" . $requestJson['password'],
                "lastlogintime" => $lastLogin,
            "ispremium" => ($account->premdays > 0 ? true : false),
            "premiumuntil" => Carbon::now()->addDays($account->premdays)->timestamp,
            "status" => "active"
        ),
            'playdata' => array(
                'worlds' => array(
                    0 => array(
                        "id" => 0,
                        "name" => "OTXServer-Global",
                        "externaladdress" => "192.168.2.100",
                        "externalport" => $ports['game'],
                        "previewstate" => 0,
                        "location" => "BRA",
                        "externaladdressunprotected" => "192.168.2.100",
                        "externaladdressprotected" => "192.168.2.100"
                    ), 
                ),
                'characters' => $characters,
            )
        );
        
        /**
         * RETURN $data AS JSON
         */
        return response()->json($data);
    }

    /**
     * Send message to client and stop with die()
     * @param  string $msg  the message that will be displayed
     */
    function sendError($msg)
    {
        $errorMsg["errorCode"] = 3;
        $errorMsg["errorMessage"] = $msg;
        
        die(json_encode($errorMsg));
    }
}
