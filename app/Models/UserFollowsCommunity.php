<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserFollowsCommunity extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'community_id'
    ];

    public function user()
    {
        return $this->hasOne(User::class, 'user_id', 'id');
    }

    public function community()
    {
        return $this->hasOne(Community::class, 'community_id', 'id');
    }
}
