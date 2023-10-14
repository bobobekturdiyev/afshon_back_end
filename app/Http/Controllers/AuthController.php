<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email|exists:users,email',
            'password' => 'required'
        ]);
        $user = User::where('email', $request->email)->first();
        if ($user == null) {
            return redirect()->back()->with([
                "message" => 'User not found',
                'm_status' => false,
            ]);
        } else {
            if (Hash::check($request->password, $user->password)) {
                Auth::loginUsingId($user->id);
                return redirect()->route('dashboard');
            } else {
                return redirect()->back()->with([
                    "message" => 'Password is uncorrect !',
                    'm_status' => false,
                ]);
            }
        }
    }
}
