<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class ShowFrontPageController extends Controller
{
    public function __invoke(Request $request)
    {
        // Get first 100 posts, sorted by most upvoted.
        $user = auth()->user();

        if ($user) {
            $posts = $user->frontPagePosts;
        } else {
            $posts = $this->getGuestPosts();
        }

        return view('frontpage', [
            'user' => $user,
            'posts' => $posts
        ]);
    }

    private function getGuestPosts()
    {
        return Post::with(['community', 'user'])
                ->where('posts.created_at', '>=', Carbon::now()->subDay()->toDateTimeString())
                ->withSum('votes as votes', 'value')
                ->limit(100)
                ->orderBy('votes', 'desc')
                ->get();
    }
}
