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

    Route::get('auth/me', 'AuthController@me')
        ->name('me');

    Route::get('users', 'UserController@index')
        ->name('get.users');

    Route::post('mario-laps', 'MarioLapController@store')
        ->name('post.mario_laps');

    Route::post('rounds', 'RoundController@store')
        ->name('post.rounds');

    Route::post('rounds/{round}/races', 'RoundRaceController@store')
        ->name('post.rounds.races');

    Route::post('races/{race}', 'UserRaceController@store')
        ->name('post.user-races');

    Route::patch('races/{race}/lap', 'RaceLapController@update')
        ->name('patch.races.lap');

    Route::patch('races/{race}/type', 'RaceTypeController@update')
        ->name('patch.races.type');
});

// Default API route
Route::get('/', function () {
    return "You've hit the Mario Laps API.";
});
