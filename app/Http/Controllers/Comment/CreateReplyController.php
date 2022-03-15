<?php

namespace App\Http\Controllers\Comment;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Mail\NewReplyNotification;
use App\Models\Comment;
use App\Models\Community;
use App\Models\Post;
use Illuminate\Support\Facades\Mail;

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

        Mail::to($comment->owner->email)->send(new NewReplyNotification($community, $post, 'comment'));

        return redirect(route('post.show', ['community' => $community, 'post' => $post->getHashId()]));
    }
}
