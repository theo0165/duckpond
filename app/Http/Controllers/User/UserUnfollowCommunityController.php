<?php

namespace App\Http\Controllers\User;

use App\Models\UserFollowsCommunity;
use App\Models\Community;
use App\Http\Controllers\Controller;

class UserUnfollowCommunityController extends Controller
{
    public function __invoke(Community $community)
    {
        $user = auth()->user()->id;

        $checkIfFollow = UserFollowsCommunity::where('community_id', $community->id)->where('user_id', $user)->first();

        if ($checkIfFollow) {
            $checkIfFollow->delete();
        }

        return back();
    }
}
