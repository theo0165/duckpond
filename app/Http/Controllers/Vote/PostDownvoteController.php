<?php

namespace App\Http\Controllers\Vote;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Community;
use App\Models\Post;
use App\Models\Vote;

class PostDownvoteController extends Controller
{

    public function __invoke(Request $request, Community $community, Post $post)
    {

        $user = auth()->user();

        $checkUpvote = Vote::where('user_id', $user->id)->where('post_id', $post->id)->where('value', 1)->first();
        $checkDownvote = Vote::where('user_id', $user->id)->where('post_id', $post->id)->where('value', -1)->first();


        if ($checkDownvote) {
            return back();
        }

        if ($checkUpvote) {
            $checkUpvote->delete();
        }

        $vote = new Vote([
            'post_id' => $post->id,
            'user_id' => auth()->user()->id,
            'value' => -1,
        ]);

        $vote->save();

        return back();
    }
}
