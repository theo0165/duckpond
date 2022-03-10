<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Vinkla\Hashids\Facades\Hashids;

class Comment extends Model
{
    use HasFactory;

    public function owner()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function children()
    {
        return $this->hasMany(Comment::class, 'parent_id', 'id')
                ->withSum('votes as vote_count', 'value');
    }

    public function votes()
    {
        return $this->hasMany(Vote::class, 'comment_id', 'id');
    }

    public function allChildren()
    {
        return $this->children()->with('allChildren')->orderByDesc('vote_count');
    }

    public function parent()
    {
        if ($this->post_id != null) {
            return $this->belongsTo(Post::class, 'post_id', 'id');
        } elseif ($this->comment_id != null) {
            return $this->belongsTo(Comment::class, 'parent_id', 'id');
        } else {
            return null;
        }
    }

    public function getHashedId()
    {
        return Hashids::encode($this->id);
    }
}
