<?php

namespace App\Http\Controllers;

use App\Models\User;

class ShowUserPostController extends Controller
{
    public function __invoke(User $user)
    {
        return view('users.posts', [
            'user' => $user,
        ]);
    }
}
