<?php

namespace App\Http\Controllers\Comment;

use App\Models\Comment;
use App\Models\Community;
use App\Models\Post;
use App\Http\Controllers\Controller;

class DeleteCommentController extends Controller
{
    public function __invoke(Comment $comment)
    {
        $this->authorize('delete', $comment);

        $comment->delete();

        return back()->with('success', 'Comment deleted!');
    }
}
