<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ShowFrontPageController extends Controller
{
    public function __invoke(Request $request)
    {
        // Get first 100 posts, sorted by most upvoted.
        $user = auth()->user();
        $posts = $user->frontPagePosts;

        return view('frontpage', [
            'user' => $user,
            'posts' => $posts
        ]);
    }
}
