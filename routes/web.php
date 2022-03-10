<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ShowLoginController;
use App\Http\Controllers\Auth\ShowRegisterController;
use App\Http\Controllers\CommunityIndexController;
use App\Http\Controllers\ShowCommunityController;
use App\Http\Controllers\ShowFrontPageController;
use App\Http\Controllers\ShowPostController;
use App\Http\Controllers\ShowUserProfileController;
use App\Http\Controllers\ShowUserPostController;
use App\Http\Controllers\ShowUserCommentController;
use App\Http\Controllers\ShowUserOwnedCommunityController;
use App\Http\Controllers\ShowUserFollowedCommunityController;
use App\Http\Controllers\EditUserProfileController;
use App\Http\Controllers\UpdateUserProfileController;
use App\Http\Controllers\DeleteUserProfileController;
use App\Http\Controllers\submit\ShowSubmitController;
use App\Http\Controllers\submit\StoreSubmitController;
use Illuminate\Support\Facades\Route;

Route::get('/', ShowFrontPageController::class)->name('frontpage');

Route::get('register', ShowRegisterController::class)->name('auth.register');
Route::post('register', RegisterController::class)->name('auth.register.user');
Route::get('login', ShowLoginController::class)->name('auth.login');
Route::post('login', LoginController::class)->name('auth.login.user');


Route::get('/c/{community:title}/p/{post:id}/upvote', fn () => response())->name('post.upvote');
Route::get('/c/{community:title}/p/{post:id}/downvote', fn () => response())->name('post.downvote');

Route::get('/c/{community:title}/p/{comment:id}/upvote', fn () => response())->name('comment.upvote');
Route::get('/c/{community:title}/p/{comment:id}/downvote', fn () => response())->name('comment.downvote');

Route::get('/c/all', CommunityIndexController::class)->name('community.index');
Route::get('/c/{community:title}', ShowCommunityController::class)->name('community.show');
Route::get('/c/{community:title}/p/{post:id}', ShowPostController::class)->name('post.show');

Route::get('u/{user:username}', ShowUserProfileController::class)->name('users.profile');
Route::get('u/{user:username}/posts', ShowUserPostController::class)->name('users.posts');
Route::get('u/{user:username}/comments', ShowUserCommentController::class)->name('users.comments');
Route::get('u/{user:username}/followed-communities', ShowUserFollowedCommunityController::class)->name('users.followed.community');
Route::get('u/{user:username}/owned-communities', ShowUserOwnedCommunityController::class)->name('users.owned.community');
// Route::get('u/{user:username}/edit', EditUserProfileController::class)->name('users.profile.edit')->middleware('can:delete,user');

// Route::get('u/{user:username}/edit', EditUserProfileController::class)->name('users.profile.edit')->can('edit', 'user');
// Route::patch('u/{user:username}/update', UpdateUserProfileController::class)->name('users.profile.update')->can('update', 'user');
// Route::delete('u/{user:username}/delete', DeleteUserProfileController::class)->name('users.profile.delete')->can('delete', 'user');

Route::get('u/{user:username}/edit', EditUserProfileController::class)->name('users.profile.edit');
Route::patch('u/{user:username}/update', UpdateUserProfileController::class)->name('users.profile.update');
Route::delete('u/{user:username}/delete', DeleteUserProfileController::class)->name('users.profile.delete');
// });

Route::group(['middleware' => 'auth'], function () {
    Route::get('/submit', ShowSubmitController::class)->name('submit.show');
    Route::post('/submit', StoreSubmitController::class)->name('submit.store');

    Route::post('logout', LogoutController::class)->name('auth.logout');
});
