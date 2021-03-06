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


/** ADD ALL LOCALIZED ROUTES INSIDE THIS GROUP **/
Route::group([
    'prefix' => LaravelLocalization::setLocale(),
    'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath', 'installed' ]
], function () {

    Route::get('/', 'HomeController@index')->name('home');

    /**
     * Auth Route Group
     */
    Route::group(['prefix' => 'auth'], function () {
        Route::get('login', 'AuthController@login')->name('auth.login');
        Route::post('login', 'AuthController@authenticate')->name('auth.auth');
        Route::post('logout', 'AuthController@logout')->name('auth.logout');
        Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
        Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
        Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
        Route::post('password/reset', 'Auth\ResetPasswordController@reset');
        Route::get('recovery', 'AuthController@showKeyRequestForm')->name('key.form');
        Route::post('recovery', 'AuthController@showRecoveryForm')->name('key.recovery');
        Route::post('recovery/password', 'AuthController@resetPassword')->name('key.recovery.password');
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
        Route::get('key/generate', 'AccountController@showKey')->name('account.show.key');
    });

    /**
     * Player Route Group
     */
    Route::group(['prefix' => 'player'], function () {
        Route::get('/', 'PlayerController@index')->name('player.index');
        Route::get('create', 'PlayerController@create')->name('player.create');
        Route::post('create', 'PlayerController@store')->name('player.store');
        Route::get('edit/{id}', 'PlayerController@edit')->name('player.edit');
        Route::post('update/{id}', 'PlayerController@update')->name('player.update');
        Route::get('delete/{id}', 'PlayerController@destroy')->name('player.delete');
        Route::get('restore/{id}', 'PlayerController@restore')->name('player.restore');
        Route::post('/', 'PlayerController@search')->name('player.search');
        Route::get('/{name}', 'PlayerController@show')->name('player.show');
    });

    /**
     * Post Route Group
     */
    //Route::get('post/{id}', 'NewsController@show')->name('post.show');

    /**
     * DashBoard Route Group
     */
    Route::group(['prefix' => 'dashboard'], function () {

        Route::get('/', 'AdminController@index')->name('dashboard.index');

        /**
         * DashBoard Post Route Group
         */
        Route::group(['prefix' => 'posts'], function () {
            Route::get('/', 'PostController@index')->name('post.index');
            Route::get('create', 'PostController@create')->name('post.create');
            Route::post('create', 'PostController@store')->name('post.store');
            Route::get('edit/{id}', 'PostController@edit')->name('post.edit');
            Route::post('update', 'PostController@edit')->name('post.update');
        });

        /**
         * DashBoard Configurations Route Group
         */
        Route::group(['prefix' => 'config'], function () {
            Route::get('/', 'ConfigController@index')->name('config.index');
            Route::post('set/path', 'ConfigController@setPath')->name('config.set.path');
        });
    });

    /**
     * Guild Route Group
     */
    Route::group(['prefix' => 'guild'], function () {
        Route::get('/', 'GuildController@index')->name('guild.index');
        Route::get('create', 'GuildController@create')->name('guild.create');
        Route::post('create', 'GuildController@store')->name('guild.store');
        Route::get('/{id}', 'GuildController@show')->name('guild.show');
    });
});

/**
 * Installer Routes
 */
Route::get('install', 'InstallerController@index')->name('install.index');
Route::post('install', 'InstallerController@install')->name('install.post');
Route::get('install/finish', 'InstallerController@finish')->name('install.finish');