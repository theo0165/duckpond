<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function __invoke(Request $request)
    {
        $credentials = $request->only('username', 'email', 'password');

        if (auth()->attempt($credentials, $request->filled('remember'))) {
            session()->regenerate();

            return redirect('dashboard'); // add flash messages later on
        }

        return back()->withErrors([
            'invalid' => 'Your provided credentials could not be verified.'
        ]);
    }
}
