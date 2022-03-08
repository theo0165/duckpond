<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ShowLoginController;
use App\Http\Controllers\Auth\ShowRegisterController;
use App\Http\Controllers\ShowUserProfileController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'home');

Route::group(['middleware' => 'guest'], function () {
    Route::get('register', ShowRegisterController::class)->name('auth.register');
    Route::post('register', RegisterController::class)->name('auth.register.user');
    Route::get('login', ShowLoginController::class)->name('auth.login');
    Route::post('login', LoginController::class)->name('auth.login.user');
});

Route::group(['middleware' => 'auth'], function () {
    Route::post('logout', LogoutController::class)->name('auth.logout');
    Route::get('u/{user:username}', ShowUserProfileController::class)->name('users.profile');
});
