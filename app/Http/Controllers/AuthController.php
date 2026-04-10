<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // tampilkan form login
    public function loginForm()
    {
        return view('auth.login');
    }

    // proses login
    public function login(Request $request)
    {
        // ✅ validasi dulu
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');

        // ✅ attempt login
        if (Auth::attempt($credentials)) {

            // 🔥 WAJIB: regenerate session (fix 419 & security)
            $request->session()->regenerate();

            $user = Auth::user();

            // cek role
            if ($user->role === 'admin') {
                return redirect()->intended('/admin/dashboard');
            }

            return redirect()->intended('/home');
        }

        // ❌ login gagal
        return back()
            ->withErrors([
                'email' => 'Email atau password salah',
            ])
            ->withInput();
    }

    // logout
    public function logout(Request $request)
    {
        Auth::logout();

        // 🔥 WAJIB: invalidate session
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}