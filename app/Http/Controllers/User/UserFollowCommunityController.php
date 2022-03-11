<?php

namespace App\Http\Controllers\User;

use App\Models\UserFollowsCommunity;
use App\Models\Community;
use App\Http\Controllers\Controller;

class UserFollowCommunityController extends Controller
{
    public function __invoke(Community $community)
    {
        $user = auth()->user()->id;

        $followCommunity = UserFollowsCommunity::with('user', 'community')->where('community_id', $community->id)->where('user_id', $user);

        $checkIfFollow = UserFollowsCommunity::where('community_id', $community->id)->where('user_id', $user)->first();

        if (!$checkIfFollow) {
            $followCommunity = new UserFollowsCommunity([
                'user_id' => $user,
                'community_id' => $community->id,
            ]);

            $followCommunity->save();
        }

        return back();
    }
}
