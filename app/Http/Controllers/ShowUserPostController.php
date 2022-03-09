<?php

namespace App\Http\Controllers;

use App\Models\User;

class ShowUserPostController extends Controller
{
    public function __invoke(User $user)
    {

        // $user = $user->posts;

        // dd($user->posts);

        return view('users.posts', [
            'user' => $user,
        ]);
    }
}
