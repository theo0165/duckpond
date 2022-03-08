<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ShowLoginController;
use App\Http\Controllers\Auth\ShowRegisterController;
use App\Http\Controllers\ShowCommunityController;
use App\Http\Controllers\ShowDashboardController;
use App\Http\Controllers\ShowFrontPageController;
use App\Http\Controllers\ShowPostController;
use App\Http\Controllers\ShowUserProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', ShowFrontPageController::class)->name('frontpage');

Route::group(['middleware' => 'guest'], function () {
    Route::get('register', ShowRegisterController::class)->name('auth.register');
    Route::post('register', RegisterController::class)->name('auth.register.user');
    Route::get('login', ShowLoginController::class)->name('auth.login');
    Route::post('login', LoginController::class)->name('auth.login.user');

    Route::get('/c/{community:title}', ShowCommunityController::class)->name('community.show');
    Route::get('/c/{community:title}/p/{post:id}', ShowPostController::class)->name('post.show');
});

Route::group(['middleware' => 'auth'], function () {
    Route::post('logout', LogoutController::class)->name('auth.logout');
    Route::get('u/{user:username}', ShowUserProfileController::class)->name('users.profile');
});
