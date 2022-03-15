<?php

namespace App\Http\Controllers\Post;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Community;
use App\Models\Post;
use Illuminate\Http\Request;

class ShowPostController extends Controller
{
    public function __invoke(Request $request, Community $community, Post $post)
    {
        $user = auth()->user() ?: null;

        $comments = $post->comments()
            ->withSum('votes as vote_count', 'value')
            ->orderByDesc('vote_count')
            ->paginate(2);
        // ->get();

        return view('post', [
            'post' => $post,
            'comments' => $comments,
            'user' => $user
        ]);
    }
}
