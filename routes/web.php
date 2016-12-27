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


Route::group(['prefix' => 'account'], function () {
 
/*
 * #LOGIN
 */
	Route::get('login', 'AuthController@login')->name('account.login');
	Route::post('login','AuthController@authenticate')->name('account.auth');
	Route::post('logout','AuthController@logout')->name('account.logout');

/*
 * #ACCOUNT
 */
	Route::get('/', 'AccountController@index')->name('account.index');
	Route::get('create', 'AccountController@create')->name('account.create');
	Route::post('create', 'AccountController@store')->name('account.store');

});

/*
 * #PLAYER
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

// Show Post
Route::get('post/{id}', 'NewsController@show')->name('post.show');

/*
 * #DASHBOARD
 */
Route::group(['prefix' => 'dashboard'], function () {

	Route::get('/', 'AdminController@index')->name('dashboard');

	/*
	 * #POSTS
	 */
	Route::get('posts', 'PostController@index')->name('post.index');
	Route::get('posts/create', 'PostController@create')->name('post.create');
	Route::post('posts/create', 'PostController@store')->name('post.store');
	Route::get('posts/edit/{id}', 'PostController@edit')->name('post.edit');
	Route::post('posts/update', 'PostController@edit')->name('post.update');
});

/*
guild
news
*/
