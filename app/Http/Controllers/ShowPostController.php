<?php

namespace App\Http\Controllers;

use App\Models\Community;
use App\Models\Post;
use Illuminate\Http\Request;

class ShowPostController extends Controller
{
    public function __invoke(Request $request, Community $community, Post $post)
    {
        //TODO: Get comments and votes
        dd($post);

        if ($post->type === "link") {
            return redirect($post->content);
        }

        $user = auth()->user() ?: null;

        return view('post', [
            'post' => $post,
            'user' => $user
        ]);
    }
}
