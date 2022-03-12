<?php

namespace App\Providers;

use App\Policies\UserPolicy;
use App\Models\User;
use App\Models\Comment;
use App\Models\Community;
use App\Models\Post;
use App\Policies\CommentPolicy;
use App\Policies\CommunityPolicy;
use App\Policies\PostPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
        User::class => UserPolicy::class,
        Comment::class => CommentPolicy::class,
        Community::class => CommunityPolicy::class,
        Post::class => PostPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
    }
}
