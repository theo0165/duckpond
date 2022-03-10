<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    public function owner()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function children()
    {
        return $this->hasMany(Comment::class, 'parent_id', 'id');
    }

    public function allChildren()
    {
        return $this->children()->with('allChildren');
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
}
