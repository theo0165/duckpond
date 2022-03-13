<?php

namespace App\Http\Controllers\Community;

use App\Http\Controllers\Controller;
use App\Models\Community;
use App\Models\UserFollowsCommunity;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class ShowCommunityController extends Controller
{
    public function __invoke(Request $request, Community $community)
    {
        $user = auth()->user() ?: null;
        // $user = auth()->user();
        $posts = $community->getPosts();

        // $checkFollows = UserFollowsCommunity::where('user_id', $user->id)->where('community_id', $community->id)->get();
        // dd($checkFollows);

        return view('community.show', [
            'user' => $user,
            'posts' => $posts,
            'community' => $community,
            // 'checkFollows' => $checkFollows,
        ]);
    }
}
