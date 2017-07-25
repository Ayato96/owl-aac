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
	$posts = \App\Post::all()->reverse();
	return view('pages.index')->with('posts', $posts);
})->name('home');


/**
 * Auth Route Group
 */
Route::group(['prefix' => 'auth'], function () {
	Route::get('login', 'AuthController@login')->name('auth.login');
	Route::post('login','AuthController@authenticate')->name('auth.auth');
	Route::post('logout','AuthController@logout')->name('auth.logout');
});

/**
 * Account Route Group
 */
Route::group(['prefix' => 'account'], function () {
	Route::get('/', 'AccountController@index')->name('account.index');
	Route::get('create', 'AccountController@create')->name('account.create');
	Route::post('create', 'AccountController@store')->name('account.store');
	Route::get('update/password', 'AccountController@changePassword')->name('account.change.password');
	Route::post('update/password', 'AccountController@updatePassword')->name('account.update.password');
});

/**
 * Player Route Group
 */
Route::group(['prefix' => 'player'], function () {
	Route::get('new', 'PlayerController@create')->name('player.create');
	Route::post('new', 'PlayerController@store')->name('player.store');
	Route::get('edit/{id}', 'PlayerController@edit')->name('player.edit');
	Route::post('update/{id}', 'PlayerController@update')->name('player.update');
	Route::get('/', 'PlayerController@index')->name('player.index');
	Route::get('/{slug}', 'PlayerController@show')->name('player.show');
	Route::post('/', function (Request $request)
	{
		$slug = str_slug($request->name, '-');
		$player = App\Player::whereSlug($slug)->first();
		if ($player) {
			return redirect()->route('player.show', [$slug]);
		}
		return redirect()->route('player.index');
	})->name('player.search');

});

/**
 * Post Route Group
 */
Route::get('post/{id}', 'NewsController@show')->name('post.show');

/**
 * DashBoard Route Group
 */
Route::group(['prefix' => 'dashboard'], function () {

	Route::get('/', 'AdminController@index')->name('dashboard');

	/**
	 * DashBoard Post Route Group
	 */
	Route::group(['prefix' => 'posts'], function() {
		Route::get('/', 'PostController@index')->name('post.index');
		Route::get('create', 'PostController@create')->name('post.create');
		Route::post('create', 'PostController@store')->name('post.store');
		Route::get('edit/{id}', 'PostController@edit')->name('post.edit');
		Route::post('update', 'PostController@edit')->name('post.update');
	});
});

/*
guild
news
*/
