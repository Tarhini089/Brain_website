<?php

use Illuminate\Support\Facades\Route;

/* Route::get('/', function () {
    return view('welcome');
}); */

Route::resource('users', UserController::class)->middleware('auth');

Auth::routes(['login' => true, 'register' => false]);

