<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class WebAuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.teacher-login'); 
    }

   public function loginAdmin(Request $request)
{
    $credentials = $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);

    $remember = $request->has('remember');

    if (Auth::attempt($credentials, $remember)) {
        if (Auth::user()->role !== 'teacher') {
            Auth::logout();
            return back()->with('error', 'You do not have teacher permissions.');
        }

        $request->session()->regenerate();
        return redirect()->intended(route('admin.dashboard'));
    }

    return back()->with('error', 'Invalid email or password.')->withInput();
}

public function logoutAdmin(Request $request)
{
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect()->route('login');
}
}