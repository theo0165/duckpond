<?php

namespace App\Http\Controllers\Auth\ResetPassword;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ShowForgotPasswordController extends Controller
{
    public function __invoke(Request $request)
    {
        return view('auth.reset-password.forgot-password');
    }
}
