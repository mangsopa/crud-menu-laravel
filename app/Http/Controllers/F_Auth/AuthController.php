<?php

namespace App\Http\Controllers\F_Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    function index()
    {
        return view('f_auth.signin');
    }

    // Proses login
    function login(Request $request)
    {
        // Validasi input
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        // Cek kredensial
        $credentials = $request->only('username', 'password');

        if (Auth::attempt($credentials)) {
            // Jika autentikasi berhasil, redirect ke dashboard
            $request->session()->regenerate();
            return redirect()->intended('dashboard')->with('success', 'Login berhasil');
        }

        // Jika autentikasi gagal, kembali ke halaman login
        return back()->withErrors([
            'loginError' => 'Invalid username or password.',
        ])->onlyInput('username');
    }

    function logout(Request $request)
    {
        // Logout user
        Auth::logout();

        // Invalidate the session
        $request->session()->invalidate();

        // Regenerate CSRF token
        $request->session()->regenerateToken();

        // Redirect to login page
        return redirect()->route('f_auth.index');
    }
}
