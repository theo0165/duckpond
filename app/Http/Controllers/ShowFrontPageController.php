<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class ShowFrontPageController extends Controller
{
    public function __invoke(Request $request)
    {
        // Get first 100 posts, sorted by most upvoted.
        $user = auth()->user() ?: null;

        if ($user) {
            $posts = $user->frontPagePosts;
        } else {
            $posts = Post::getGuestPosts();
        }

        return view('frontpage', [
            'user' => $user,
            'posts' => $posts
        ]);
    }
}
