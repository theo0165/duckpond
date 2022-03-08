<?php

namespace App\Http\Controllers;

use App\Models\User;

class ShowUserProfileController extends Controller
{
    public function __invoke(User $user)
    {
        $user = User::findOrFail(auth()->id());
        $info = User::with(['posts'])->findOrFail(auth()->id());
        return view('users.profile', [
            'user' => $user,
            'info' => $info
        ]);
    }
}
