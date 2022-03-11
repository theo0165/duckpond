<?php

namespace App\Http\Controllers\Comment;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Community;
use App\Models\Post;
use Illuminate\Http\Request;

class CreateCommentController extends Controller
{
    public function __invoke(Request $request, Community $community, Post $post)
    {
        $data = $request->validate([
            'content' => ['required', 'string', 'min:1']
        ]);

        $comment = new Comment([
            'content' => $data['content'],
            'user_id' => auth()->user()->id,
            'post_id' => $post->id
        ]);

        $comment->save();

        return back();
    }
}
