<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
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
