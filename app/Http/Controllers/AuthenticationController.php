<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthenticationController extends Controller
{
    public function authenticate(Request $request)
    {
        $data = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($data)) {
            $request->session()->regenerate();

            return redirect()->route('user-dashboard');
        }

        return back()->withErrors([
            'error_field' => 'The provided credentials do not match our records.',
        ]);
    }

    public function register(Request $request)
    {
        $data = $request->validate([
            'email' => ['required', 'email', 'unique:users'],
            'password' => ['required', 'confirmed'],
            'password_confirmation' => ['required'],
        ]);

        $hashed_password = bcrypt($data['password']);

        User::create([
            'email' => $data['email'],
            'password' => $hashed_password
        ]);

        return back()->with('message', 'Successfully registered, please login');
    }

    //Log User Out
    public function logout()
    {
        auth()->logout();

        session()->invalidate();
        session()->regenerateToken();

        return redirect('/');
    }

    public function show_registration()
    {
        return view('registration');
    }

    public function show_authentication()
    {
        return view('authentication');
    }
}
