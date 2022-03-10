<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;

class ShowUserOwnedCommunityController extends Controller
{
    public function __invoke(User $user)
    {
        return view('users.owned-community', [
            'user' => $user,
        ]);
    }
}
