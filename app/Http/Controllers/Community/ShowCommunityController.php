<?php

namespace App\Http\Controllers\Community;

use App\Http\Controllers\Controller;
use App\Models\Community;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class ShowCommunityController extends Controller
{
    public function __invoke(Request $request, Community $community)
    {
        $user = auth()->user() ?: null;
        $posts = $community->getPosts();

        return view('community.show', [
            'user' => $user,
            'posts' => $posts,
            'community' => $community
        ]);
    }
}
