<?php

declare(strict_types=1);

/**
 * Public routes
 */
Route::post('users', 'UserController@store')
    ->name('register');
Route::post('auth/login', 'AuthController@login')
    ->name('login');

/**
 * Protected routes
 */
Route::group(['middleware' => 'auth:api'], function () {

    Route::post('auth/logout', 'AuthController@logout')
        ->name('logout');

    Route::get('users', 'UserController@index')
        ->name('get.users');

    Route::get('sessions', 'SessionController@index')
        ->name('get.active_sessions');

    Route::post('rounds', 'RoundController@store')
        ->name('post.rounds');

    Route::post('rounds/{round}/races', 'RoundRaceController@store')
        ->name('post.rounds.races');

    Route::post('races/{race}', 'UserRaceController@store')
        ->name('post.user-races');
});
