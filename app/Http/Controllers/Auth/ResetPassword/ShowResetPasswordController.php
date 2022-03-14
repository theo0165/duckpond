<?php

namespace App\Http\Controllers\Auth\ResetPassword;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ShowResetPasswordController extends Controller
{
    public function __invoke(Request $request, string $token)
    {
        $resetData = DB::table('password_resets')->where('token', $token)->first();

        if(!$resetData){
            return response('Invalid token', 400);
        }

        return view('auth.reset-password.reset-password', ['token' => $resetData->token]);
    }
}
