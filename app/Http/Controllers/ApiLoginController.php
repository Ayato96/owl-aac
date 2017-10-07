<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\ConfigLuaController as ConfigLua;
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
         */
        $configLua = (new ConfigLua)->getAll();
        $lastLogin=0;
        
        /**
         * GET CONTENT OF GAME FORM
         */
        $requestJson = json_decode($request->getContent(), true);

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
         * TODO: ispremium and premiumuntil: premium or vip?
         */
        $data = array(
            'session' => array(
                "sessionkey" => $requestJson['accountname'] . "\n" . $requestJson['password'],
                "lastlogintime" => $lastLogin,
            "ispremium" => ($configLua['freePremium'] ? true : ($account->premdays > 0 ? true : false)),
            "premiumuntil" => Carbon::now()->addDays($account->premdays)->timestamp,
            "status" => "active"
        ),
            'playdata' => array(
                'worlds' => array(
                    0 => array(
                        "id" => 0,
                        "name" => $configLua['serverName'],
                        "externaladdress" => $configLua['ip'],
                        "externalport" => $configLua['gameProtocolPort'],
                        "previewstate" => 0,
                        "location" => "BRA",
                        "externaladdressunprotected" => $configLua['ip'],
                        "externaladdressprotected" => $configLua['ip']
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
