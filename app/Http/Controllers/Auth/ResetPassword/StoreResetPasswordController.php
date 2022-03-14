<?php

namespace App\Http\Controllers\Auth\ResetPassword;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StoreResetPasswordController extends Controller
{
    public function __invoke(Request $request, string $token)
    {
        $resetData = DB::table('password_resets')->where('token', $token)->first();

        if (!$resetData) {
            return response('Invalid token', 400);
        }

        $data = $request->validate([
            'password' => ['required', 'string', 'confirmed', 'min:8', 'max:255']
        ]);

        $user = User::where('email', $resetData->email)->firstOrFail();

        $user->password = $data['password'];
        $user->save();

        DB::table('password_resets')->where('token', '=', $token)->delete();

        return redirect('/login');
    }
}
