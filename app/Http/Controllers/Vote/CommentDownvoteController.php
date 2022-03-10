<?php

namespace App\Http\Controllers\Vote;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Community;
use App\Models\Comment;
use App\Models\Vote;

class CommentDownvoteController extends Controller
{
    public function __invoke(Request $request, Community $community, Comment $comment)
    {

        $user = auth()->user();

        $checkUpvote = Vote::where('user_id', $user->id)->where('comment_id', $comment->id)->where('value', 1)->first();
        $checkDownvote = Vote::where('user_id', $user->id)->where('comment_id', $comment->id)->where('value', -1)->first();


        if ($checkDownvote) {
            return back();
        }

        if ($checkUpvote) {
            $checkUpvote->delete();
        }

        $vote = new Vote([
            'comment_id' => $comment->id,
            'user_id' => auth()->user()->id,
            'value' => -1,
        ]);

        $vote->save();

        return back();
    }
}
