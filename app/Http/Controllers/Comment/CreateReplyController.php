<?php

namespace App\Http\Controllers\Comment;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Community;
use App\Models\Post;

class CreateReplyController extends Controller
{
    public function __invoke(Request $request, Community $community, Post $post, Comment $comment)
    {
        $data = $request->validate([
            'content' => ['required', 'string', 'min:1']
        ]);

        $reply = new Comment([
            'content' => $data['content'],
            'user_id' => auth()->user()->id,
            'parent_id' => $comment->id
        ]);

        $reply->save();

        return redirect(route('post.show', ['community' => $community, 'post' => $post->getHashId()]));
    }
}
