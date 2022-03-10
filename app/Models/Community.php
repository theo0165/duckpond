<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Community extends Model
{
    use HasFactory;

    public function owner()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function posts()
    {
        return $this->hasMany(Post::class, 'community_id', 'id');
    }

    public function getPosts()
    {
        return $this->posts()
                    ->with(['community', 'user'])
                    ->where('posts.created_at', '>=', Carbon::now()->subDay()->toDateTimeString())
                    ->withCount('comments')
                    ->withSum('votes as votes', 'value')
                    ->limit(100)
                    ->orderBy('votes', 'desc')
                    ->get();
    }
}
