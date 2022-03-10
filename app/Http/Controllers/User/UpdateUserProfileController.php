<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Validation\Rule;

class UpdateUserProfileController extends Controller
{
    public function __invoke(User $user)
    {
        // $this->authorize('update', $user);

        $attributes = request()->validate([
            'email' => ['string', 'max:255', Rule::unique('users')->ignore($user)],
            'username' => ['string', 'max:255', 'unique:users'],
            'password' => ['string', 'min:8', 'max:255',]
        ]);

        $user->update($attributes);

        return redirect()->route('users.profile', $user);
    }
}
