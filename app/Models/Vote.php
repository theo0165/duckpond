<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vote extends Model
{
    use HasFactory;

    protected $fillable = [
        'post_id',
        'comment_id',
        'value',
        'user_id',
    ];

    public function parent()
    {
        if ($this->post_id != null) {
            return $this->belongsTo(Post::class, 'post_id', 'id');
        } elseif ($this->comment_id != null) {
            return $this->belongsTo(Comment::class, 'comment_id', 'id');
        } else {
            return null;
        }
    }
}
