<?php

namespace App\Http\Controllers\Auth\ResetPassword;

use App\Http\Controllers\Controller;
use App\Mail\ForgotPassword;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Str;

class StoreForgotPasswordController extends Controller
{
    public function __invoke(Request $request)
    {
        $data = $request->validate([
            'email' => ['required', 'string', 'email', 'exists:users,email']
        ]);

        $token = Str::random(64);

        DB::table('password_resets')->insert([
            'token' => $token,
            'email' => $data['email'],
            'created_at' => date('Y-m-d H:m:s', strtotime('now'))
        ]);

        Mail::to($data['email'])->send(new ForgotPassword($token));

        return view('auth.reset-password.forgot-sent');
    }
}
