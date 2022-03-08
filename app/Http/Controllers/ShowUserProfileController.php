<?php

namespace App\Http\Controllers;

use App\Models\User;

class ShowUserProfileController extends Controller
{
    public function __invoke(User $user)
    {
        return view('users.profile', [
            'user' => $user
        ]);
    }
}
