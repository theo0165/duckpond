<?php

namespace App\Http\Controllers\submit;

use App\Http\Controllers\Controller;
use App\Models\Community;
use App\Models\Post;
use App\Models\UserFollowsCommunity;
use App\Rules\PostTypeRule;
use Illuminate\Http\Request;

class StoreSubmitController extends Controller
{
    public function __invoke(Request $request)
    {
        $postData = $request->validate([
            'type' => ['required', 'string', 'in:text,link'],
            'title' => ['required', 'string'],
            'content' => ['required', 'string', new PostTypeRule()],
            'community' => ['required', 'exists:communities,title']
        ]);

        $community = Community::where('title', $postData['community'])->first();

        //dd(auth()->user()->followedCommunities()->where('community_id', $community->id));
        if (!auth()->user()->followedCommunities()->where('community_id', $community->id)->first()) {
            return redirect(route('submit.show'))->with('error', "You need to follow /c/{$community->title} to post to it");
        }

        $post = new Post([
            'type' => $postData['type'],
            'title' => $postData['title'],
            'content' => $postData['content'],
            'community_id' => $community->id,
            'user_id' => auth()->user()->id
        ]);

        $post->save();

        return redirect(route('post.show', [
            'post' => $post->getHashId(),
            'community' => $community
        ]));
    }
}
