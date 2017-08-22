<?php

use Illuminate\Http\Request;
use Hash;
use App\Account;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/login', function (Request $request) {
    $requestJson = json_decode($request->getContent(), true); 
    $account = Account::where('name', $requestJson['name'])
                      ->where('password', Hash::make($requestJson['password']))->first();
    $players = $account->players;

    $lastLogin=0;
    foreach ($players as $player) {
        $accountPlayers[] = array(
            "worldid" => 0,
            "name" => $player->name,
            "ismale" => (($player->sex == 1) ? true : false),
            "tutorial" => (($player->name > 0) ? false:true)            
        );
        if ($lastLogin < $player->lastlogin) {
            $lastLogin = $player->lastlogin;
        }
    }

    $return[] = array(
        'session' => array(
            "sessionkey" => $account->name . "\n" . $account->password,
            "lastlogintime" => $lastLogin,
            "ispremium" => ($account->premdays > 0 ? true : false),
            "premiumuntil" => 10,
            "status" => "active"
        ),
        'playdata' => array(
            'worlds' => array(
                "id" => 0,
                "name" => "teste",
                "externaladdress" => "192.168.2.100",
                "externalport" => 7172,
                "previewstate" => 0,
                "location" => "BRA",
                "externaladdressunprotected" => "192.168.2.100",
                "externaladdressprotected" => "192.168.2.100" 
            ),
            'characters' => $accountPlayers
        )
    );
    return response()->json($return);
})->middleware('api');
