<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;
use App\Models\User;
use App\Models\Comment;
use App\Models\Post;
use Vinkla\Hashids\Facades\Hashids;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The path to the "home" route for your application.
     *
     * This is used by Laravel authentication to redirect users after login.
     *
     * @var string
     */
    public const HOME = '/';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        $this->configureRateLimiting();
        //Overwite route binding for posts, need to decode hashed id to compare to db id.
        Route::bind('post', function ($value) {
            return Post::where('id', Hashids::decode($value))
                ->with(['community', 'user', 'comments'])
                ->withCount('comments')
                ->withSum('votes as votes', 'value')
                ->firstOrFail();
        });

        Route::bind('comment', function ($value) {
            return Comment::where('id', Hashids::decode($value))->firstOrFail();
        });

        $this->routes(function () {
            Route::prefix('api')
                ->middleware('api')
                ->group(base_path('routes/api.php'));

            Route::middleware('web')
                ->group(base_path('routes/web.php'));
        });

        Route::bind('user', function ($value) {
            return User::where('username', $value)->withCount(['posts', 'comments', 'ownedCommunities', 'followedCommunities'])->firstOrFail();
        });
    }

    /**
     * Configure the rate limiters for the application.
     *
     * @return void
     */
    protected function configureRateLimiting()
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
        });
    }
}
