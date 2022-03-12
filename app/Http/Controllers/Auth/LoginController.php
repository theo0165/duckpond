<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    public function __invoke(Request $request)
    {
        $credentials = $request->validate([
            'username' => ['required', 'max:255'],
            'password' => ['required', 'min:8', 'max:255'],
        ]);

        if (auth()->attempt($credentials, $request->filled('remember'))) {
            session()->regenerate();

            return redirect('/')->with('success', 'Welcome back!');
        } else {
            return back()->with('error', 'Invalid credentials');
        }
    }
}
