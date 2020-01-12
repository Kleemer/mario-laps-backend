<?php

declare(strict_types=1);

use Illuminate\Routing\Route;

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
});
