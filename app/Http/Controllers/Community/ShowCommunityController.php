<?php

namespace App\Http\Controllers\Community;

use App\Http\Controllers\Controller;
use App\Models\Community;
use App\Models\UserFollowsCommunity;

class ShowCommunityController extends Controller
{
    public function __invoke(Community $community)
    {
        $user = auth()->user() ?: null;
        $posts = $community->getPosts();
        // dd($posts);
        $checkFollows = null;

        if (auth()->user()) {
            $checkFollows = UserFollowsCommunity::where('user_id', $user->id)->where('community_id', $community->id)->first();
        }

        return view('community.show', [
            'user' => $user,
            'posts' => $posts,
            'community' => $community,
            'checkFollows' => $checkFollows,
        ]);
    }
}
