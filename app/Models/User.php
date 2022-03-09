<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Carbon;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'username',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'is_admin' => 'boolean'
    ];

    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = bcrypt($password);
    }

    public function posts()
    {
        return $this->hasMany(Post::class, 'user_id', 'id')
            ->with(['community', 'user'])
            ->where('posts.created_at', '>=', Carbon::now()->subDay()->toDateTimeString())
            ->withCount('comments')
            ->withSum('votes as votes', 'value');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class, 'user_id', 'id');
    }

    public function ownedCommunities()
    {
        return $this->hasMany(Community::class, 'user_id', 'id');
    }

    public function followedCommunities()
    {
        return $this->hasManyThrough(
            Community::class,
            UserFollowsCommunity::class,
            'user_id',
            'id',
            'id',
            'community_id'
        );
    }

    public function frontPagePosts()
    {
        return $this->hasManyThrough(
            Post::class,
            UserFollowsCommunity::class,
            'user_id',
            'community_id',
            '',
            'community_id'
        )
            ->with(['community', 'user'])
            ->where('posts.created_at', '>=', Carbon::now()->subDay()->toDateTimeString())
            ->withCount('comments')
            ->withSum('votes as votes', 'value')
            ->limit(100)
            ->orderBy('votes', 'desc');
    }
}
