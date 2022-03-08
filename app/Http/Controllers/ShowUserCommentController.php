<?php

namespace App\Http\Controllers;

use App\Models\User;

class ShowUserCommentController extends Controller
{
    public function __invoke(User $user)
    {
        return view('users.comments', [
            'user' => $user,
        ]);
    }
}
