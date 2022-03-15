<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Vinkla\Hashids\Facades\Hashids;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
        'title',
        'content',
        'community_id',
        'user_id'
    ];

    // protected function id(): Attribute
    // {
    //     return Attribute::make(
    //         get: fn ($value) => Hashids::encode($value),
    //         set: fn ($value) => Hashids::decode($value)
    //     );
    // }

    public function comments()
    {
        return $this->hasMany(Comment::class, 'post_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function community()
    {
        return $this->belongsTo(Community::class, 'community_id', 'id');
    }

    public function votes()
    {
        return $this->hasMany(Vote::class, 'post_id', 'id');
    }

    public function excerpt()
    {
        if (strlen($this->content) <= 140) {
            return $this->content;
        }

        $words = explode(" ", $this->content);
        $words = array_slice($words, 0, 40);

        return implode(" ", $words) . "...";
    }

    public static function getGuestPosts()
    {
        return Post::with(['community', 'user'])
            ->where('posts.created_at', '>=', Carbon::now()->subDay()->toDateTimeString())
            ->withCount('comments')
            ->withSum('votes as votes', 'value')
            ->limit(50)
            ->orderBy('votes', 'desc')
            ->paginate(50);
        // ->get();
    }

    public static function searchPosts(string $query)
    {
        return Post::with(['community', 'user'])
            ->where('title', 'LIKE', "%{$query}%")
            ->orWhere('content', 'LIKE', "%{$query}%")
            ->withCount('comments')
            ->withSum('votes as votes', 'value')
            ->limit(100)
            ->orderBy('votes', 'desc')
            ->get();
    }

    public function getHashId()
    {
        return Hashids::encode($this->id);
    }
}
