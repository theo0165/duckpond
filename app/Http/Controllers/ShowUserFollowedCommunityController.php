<?php

namespace App\Http\Controllers;

use App\Models\User;

class ShowUserFollowedCommunityController extends Controller
{
    public function __invoke(User $user)
    {
        return view('users.followed-community', [
            'user' => $user,
        ]);
    }
}
