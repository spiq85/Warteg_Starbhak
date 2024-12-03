<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // Menampilkan form login
    public function showLoginForm()
    {
        return view('auth.login'); // Pastikan Anda memiliki view 'auth.login'
    }

    // Menampilkan form registrasi
    public function showRegistrationForm()
    {
        return view('auth.register'); // Pastikan Anda memiliki view 'auth.register'
    }

    public function register(Request $request)
    {
        // Validasi input dari pengguna
        $request->validate([
            'username' => 'required|string|unique:users|max:255',
            'password' => 'required|string|min:6|confirmed', // Menambahkan konfirmasi password
        ]);

        // Buat user baru dan set role sebagai staff
        User::create([
            'username' => $request->username,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('login')->with('success', 'Registration successful. You can now log in.');
    }

    public function login(Request $request)
    {
        // Validasi input dari pengguna
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        // Cek kredensial dan login
        if (Auth::attempt($request->only('username', 'password'))) {
            // Jika berhasil login, redirect ke dashboard
            return redirect()->route('dashboard')->with('success', 'Welcome back!');
        }

        // Jika gagal login, redirect kembali dengan pesan error
        return redirect()->back()->withErrors(['username' => 'Invalid credentials.'])->withInput();
    }

    public function logout()
    {
        Auth::logout(); // Logout pengguna
        return redirect()->route('login')->with('success', 'You have been logged out.');
    }
}
