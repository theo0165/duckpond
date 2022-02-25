<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Community extends Model
{
    use HasFactory;

    public function owner(){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function posts(){
        return $this->hasMany(Post::class, 'community_id', 'id');
    }
}
