<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class DeleteUserProfileController extends Controller
{
    public function __invoke(Request $request, User $user)
    {
        $this->authorize('delete', $user);

        $user->delete();

        $request->session()->invalidate();

        return redirect('/');
    }
}
