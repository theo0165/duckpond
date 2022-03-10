<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
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
