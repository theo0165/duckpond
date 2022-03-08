<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class ShowLoginController extends Controller
{
    public function __invoke()
    {
        return view('auth.login');
    }
}
