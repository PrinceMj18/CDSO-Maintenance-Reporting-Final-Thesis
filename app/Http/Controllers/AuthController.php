<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    function login()
    {
        return view('auth.login');
    }

    function showSignup()
    {
        return view('auth.signup');
    }

    public function doLogin(Request $request)
    {
            $credentials = $request->validate([
        'email' => ['required', 'email'],
        'password' => ['required'],
    ]);

        if (Auth::attempt($credentials)) {

            $user = Auth::user();

            if ($user->role->name === 'admin') {
                return redirect('/dashboard/admin');
            }

            if ($user->role->name === 'personnel') {
                return redirect('/dashboard/personnel');
            }
            
            if ($user->role->name === 'superadmin'){
                return redirect('/dashboard/superadmin');
            }

            return redirect('/dashboard/user');
        }

            return back()
        ->withInput($request->only('email'))
        ->withErrors([
            'email' => 'Invalid email or password, or your account is unavailable.',
        ]);
    }

    function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }

    
}