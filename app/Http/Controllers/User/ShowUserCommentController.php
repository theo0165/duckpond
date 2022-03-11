<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;

class ShowUserCommentController extends Controller
{
    public function __invoke(User $user)
    {
        $commentsWithData = $user->comments()->withCount('votes')->get();

        return view('users.comments', [
            'user' => $user,
            'commentsWithData' => $commentsWithData,
        ]);
    }
}
