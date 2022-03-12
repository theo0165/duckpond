<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Http\Controllers\Controller;

class RegisterController extends Controller
{
    public function __invoke()
    {
        $attributes = request()->validate([
            'username' => ['required', 'string', 'max:255', 'unique:users'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'max:255'],
        ]);

        $user = User::create($attributes); // password is being hashed in the user model through a set mutator

        auth()->login($user);

        return redirect('/')->with('success', 'Welcome!'); // add flash messages later on
    }
}
