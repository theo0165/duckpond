<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ResetPassword\ShowForgotPasswordController;
use App\Http\Controllers\Auth\ResetPassword\ShowResetPasswordController;
use App\Http\Controllers\Auth\ResetPassword\StoreForgotPasswordController;
use App\Http\Controllers\Auth\ResetPassword\StoreResetPasswordController;
use App\Http\Controllers\Auth\ShowLoginController;
use App\Http\Controllers\Auth\ShowRegisterController;
use App\Http\Controllers\Comment\CreateCommentController;
use App\Http\Controllers\Comment\ShowCreateCommentController;
use App\Http\Controllers\Comment\CreateReplyController;
use App\Http\Controllers\Comment\DeleteCommentController;
use App\Http\Controllers\Vote\CommentDownvoteController;
use App\Http\Controllers\Vote\CommentUpvoteController;
use App\Http\Controllers\Community\CommunityIndexController;
use App\Http\Controllers\Community\CreateCommunityController;
use App\Http\Controllers\Community\DeleteCommunityController;
use App\Http\Controllers\Community\StoreCommunityController;
use App\Http\Controllers\Community\ShowCommunityController;
use App\Http\Controllers\ShowFrontPageController;
use App\Http\Controllers\Post\DeletePostController;
use App\Http\Controllers\Post\ShowPostController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\submit\ShowSubmitController;
use App\Http\Controllers\submit\StoreSubmitController;
use App\Http\Controllers\User\ShowUserProfileController;
use App\Http\Controllers\User\ShowUserPostController;
use App\Http\Controllers\User\ShowUserCommentController;
use App\Http\Controllers\User\ShowUserOwnedCommunityController;
use App\Http\Controllers\User\ShowUserFollowedCommunityController;
use App\Http\Controllers\User\EditUserProfileController;
use App\Http\Controllers\User\UpdateUserProfileController;
use App\Http\Controllers\User\DeleteUserProfileController;
use App\Http\Controllers\User\UserFollowCommunityController;
use App\Http\Controllers\User\UserUnfollowCommunityController;
use App\Http\Controllers\Vote\PostDownvoteController;
use App\Http\Controllers\Vote\PostUpvoteController;

use Illuminate\Support\Facades\Route;

Route::group(['middleware' => 'auth'], function () {
    Route::get('/c/create', CreateCommunityController::class)->name('community.create');
    Route::post('/c/create', StoreCommunityController::class)->name('community.store');

    Route::post('/c/{community:title}/p/{post}/upvote', PostUpvoteController::class)->name('post.upvote');
    Route::post('/c/{community:title}/p/{post}/downvote', PostDownvoteController::class)->name('post.downvote');
    Route::post('/c/{community:title}/c/{comment}/upvote', CommentUpvoteController::class)->name('comment.upvote');
    Route::post('/c/{community:title}/c/{comment}/downvote', CommentDownvoteController::class)->name('comment.downvote');
    Route::delete('/c/{community:title}', DeleteCommunityController::class)->name('community.delete');

    Route::get('u/{user:username}/edit', EditUserProfileController::class)->name('users.profile.edit');
    Route::patch('u/{user:username}/update', UpdateUserProfileController::class)->name('users.profile.update');
    Route::delete('u/{user:username}/delete', DeleteUserProfileController::class)->name('users.profile.delete');

    Route::get('/submit', ShowSubmitController::class)->name('submit.show');
    Route::post('/submit', StoreSubmitController::class)->name('submit.store');

    Route::delete('/c/{community:title}/p/{post}/delete', DeletePostController::class)->name('post.delete');

    Route::post('/c/{community:title}/p/{post}/comment/create', CreateCommentController::class)->name('post.comment.create');
    Route::post('/c/{community:title}/p/{post}/comment/{comment}/create', CreateReplyController::class)->name('comment.reply.create');
    Route::get('/c/{community:title}/p/{post}/comment/{comment}/create', ShowCreateCommentController::class)->name('comment.show');
    Route::delete('/c/{community:title}/p/{post}/comment/{comment}/delete', DeleteCommentController::class)->name('comment.delete');

    Route::post('logout', LogoutController::class)->name('auth.logout');
    Route::post('/c/{community:title}/follow', UserFollowCommunityController::class)->name('user.follow');
    Route::post('/c/{community:title}/unfollow', UserUnfollowCommunityController::class)->name('user.unfollow');
});

Route::get('/', ShowFrontPageController::class)->name('frontpage');

Route::get('login', ShowLoginController::class)->name('login');
Route::post('login', LoginController::class)->name('auth.login.user');

Route::get('/c/all', CommunityIndexController::class)->name('community.index');
Route::get('/c/{community:title}', ShowCommunityController::class)->name('community.show');
Route::get('/c/{community:title}/p/{post}', ShowPostController::class)->name('post.show');

Route::get('u/{user:username}', ShowUserProfileController::class)->name('users.profile');
Route::get('u/{user:username}/posts', ShowUserPostController::class)->name('users.posts');
Route::get('u/{user:username}/comments', ShowUserCommentController::class)->name('users.comments');
Route::get('u/{user:username}/followed-communities', ShowUserFollowedCommunityController::class)->name('users.followed.community');
Route::get('u/{user:username}/owned-communities', ShowUserOwnedCommunityController::class)->name('users.owned.community');

Route::get('/search', SearchController::class)->name('search');

Route::group(['middleware' => 'guest'], function () {
    Route::get('register', ShowRegisterController::class)->name('auth.register');
    Route::post('register', RegisterController::class)->name('auth.register.user');

    Route::get('/forgot-password', ShowForgotPasswordController::class)->name('forgotpassword.show');
    Route::get('/reset-password/{token}', ShowResetPasswordController::class)->name('resetpassword.show');
    Route::post('/forgot-password', StoreForgotPasswordController::class)->name('forgotpassword.store');
    Route::post('/reset-password/{token}', StoreResetPasswordController::class)->name('resetpassword.store');
});
