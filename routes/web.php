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
use Illuminate\Http\Request;

Route::get('/', function ()
{
	return view('pages.index');
})->name('home');

/*
 * #LOGIN
 */
Route::get('account/login', 'AuthController@login')->name('account.login');
Route::post('account/login','AuthController@authenticate')->name('account.auth');
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
Route::get('player', 'PlayerController@index')->name('player.index');
Route::get('player/{slug}', 'PlayerController@show')->name('player.show');
Route::post('player', function (Request $request)
{
	$slug = str_slug($request->name, '-');
	$player = App\Player::whereSlug($slug)->first();
	if ($player) {
		return redirect()->route('player.show', [$slug]);
	}
	return redirect()->route('player.index');
})->name('player.search');

/*
 * #DASHBOARD
 */
Route::get('dashboard', 'AdminController@index')->name('dashboard');

/*Route::get('dashboard/news', 'NewsController@index')->name('news.index');
Route::get('dashboard/news/create', 'NewsController@create')->name('news.create');
Route::post('dashboard/news/create', 'NewsController@store')->name('news.store');
Route::get('dashboard/news/{id}', 'NewsController@show')->name('news.show');
Route::get('dashboard/news/edit/{id}', 'NewsController@edit')->name('news.edit');*/


/*
accountmanagent
player
guild
news
*/
