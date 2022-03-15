<?php

namespace App\Http\Controllers\Community;

use App\Models\UserFollowsCommunity;
use App\Http\Controllers\Controller;
use App\Models\Community;
use Illuminate\Http\Request;

class StoreCommunityController extends Controller
{
    public function __invoke(Request $request)
    {
        $user = auth()->user()->id;

        $this->validate($request, [
            'title' => [
                'required',
                'string',
                'max:255',
                'unique:reserved_words,word',
                'unique:communities,title',
                'regex:/^[a-z]*$/i'
            ]
        ], [
            'title.unique' => "This community already exists",
            'regex' => 'Invalid community name, no spaces, numbers or special characters allowed.'
        ]);

        $newCommunity = Community::create([
            'user_id' => $user,
            'title' => $request->title,
        ]);

        $autoFollow = UserFollowsCommunity::create([
            'user_id' => $user,
            'community_id' => $newCommunity->id,
        ]);

        $autoFollow->save();

        return redirect()->route('community.show', $newCommunity)->with('success', 'Community created!');
    }
}
