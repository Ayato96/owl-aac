<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/
use Thetispro\Setting\Facades\Setting;

Route::get('/', function () {
	
	return view('pages.index');
	
});

/*
 * #LOGIN
 */
Route::get('account/login', 'AuthController@login')->name('account.login');
Route::post('account/auth','AuthController@authenticate')->name('account.auth');
Route::post('account/logout','AuthController@logout')->name('account.logout');

/*
 * #ACCOUNT
 */

Route::get('account', 'AccountController@index')->name('account.index');
Route::get('account/create', 'AccountController@create')->name('account.create');
Route::post('account/create', 'AccountController@store')->name('account.store');

/*
 * #PLAYER
 */
Route::get('account/createcharacter', 'PlayerController@create')->name('player.create');
Route::post('account/createcharacter', 'PlayerController@store')->name('player.store');

/*
accountmanagent
player
guild
news
*/