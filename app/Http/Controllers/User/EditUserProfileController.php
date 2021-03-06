<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;

class EditUserProfileController extends Controller
{
    public function __invoke(User $user)
    {
        $this->authorize('edit', $user);

        return view('users.edit', [
            'user' => $user
        ]);
    }
}
