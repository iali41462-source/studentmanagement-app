<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class LoginController extends Controller
{
    /**
     * Login Page
     */
    public function index()
    {
        if (Auth::check()) {
        return redirect()->route('students.index');
    }
        return view('auth.login');
    }

    /**
     * User Login
     */
    public function login(LoginRequest $request)
    {

        // Sirf email aur password lo
        $credentials = $request->only('email', 'password');

        // Remember Me checkbox check karo
        $remember = $request->filled('remember');

        // Login attempt
        if (Auth::attempt($credentials, $remember)) {

            // Security ke liye session regenerate karo
            $request->session()->regenerate();

            // Dashboard par bhej do
            return redirect()->route('students.index')
                             ->with('success', 'Welcome Back!');
        }

        // Agar email ya password ghalat ho
        return back()
            ->withErrors([
                'email' => 'Invalid Email or Password.',
            ])
            ->withInput();
    }

    /**
     * Logout
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
