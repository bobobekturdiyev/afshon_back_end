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
        if (!$user) {
            return redirect()->back()->withErrors(['password' => 'User is not found']);
        } else {
            if (Hash::check($request->password, $user->password)) {
                Auth::login($user);
                return redirect()->route('dashboard');
            } else {
                return redirect()->back()->withErrors(['password' => 'Password is incorrect']);
            }
        }
    }
}
