<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\Community;
use App\Models\Post;
use App\Models\User;
use App\Models\UserFollowsCommunity;
use App\Models\Vote;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $admin = new User([
            'username' => 'admin',
            'email' => 'admin@admin.com',
            'email_verified_at' => now(),
            'password' => 'password',
            'remember_token' => Str::random(10),
            'is_admin' => true
        ]);

        $admin->save();

        User::factory()->count(100)->create();
        Community::factory()->count(10)->create();
        Post::factory()->link_type()->count(75)->create();
        Post::factory()->text_type()->count(75)->create();
        Comment::factory()->on_post()->count(100)->create();
        Comment::factory()->on_comment()->count(100)->create();
        UserFollowsCommunity::factory()->count(50)->create();
        Vote::factory()->upvote()->on_comment()->count(250)->create();
        Vote::factory()->downvote()->on_comment()->count(250)->create();
        Vote::factory()->upvote()->on_post()->count(250)->create();
        Vote::factory()->downvote()->on_post()->count(250)->create();

        foreach(Community::all() as $community){
            $follow = new UserFollowsCommunity([
                'user_id' => $admin->id,
                'community_id' => $community->id
            ]);

            $follow->save();
        }
    }
}
