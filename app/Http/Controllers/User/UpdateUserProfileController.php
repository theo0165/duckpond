<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Validation\Rule;

class UpdateUserProfileController extends Controller
{
    public function __invoke(User $user)
    {
        $this->authorize('update', $user);

        $attributes = request()->validate([
            'email' => ['string', 'max:255', 'unique:users,email,' . $user->id],
            'username' => ['string', 'max:255', 'unique:users,username,' . $user->id],
            'password' => ['nullable', 'string', 'min:8', 'max:255',]
        ]);

        if ($attributes['password']) {
            $user->update([
                'email' => $attributes['email'],
                'username' => $attributes['username'],
            ]);
        } else {
            $user->update($attributes);
        }

        return redirect()->route('users.profile', $user);
    }
}
