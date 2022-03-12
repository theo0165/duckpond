<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;

class LogoutController extends Controller
{
    public function __invoke()
    {
        auth()->logout();

        session()->invalidate();

        session()->regenerateToken();

        return redirect('/')->with('success', 'Goodbye for now!'); // add flash messages later on
    }
}
