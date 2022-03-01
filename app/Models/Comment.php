<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    public function children()
    {
        return $this->hasMany(Comment::class, 'comment_id', 'id');
    }

    public function parent()
    {
        if($this->post_id != null){
            return $this->belongsTo(Post::class, 'post_id', 'id');
        }else if($this->comment_id != null){
            return $this->belongsTo(Comment::class, 'comment_id', 'id');
        }else{
            return null;
        }
    }
}
