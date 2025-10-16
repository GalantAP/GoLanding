<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // Halaman login
    public function showLoginForm()
    {
        // Jika pengguna sudah login, arahkan ke dashboard
        if (Auth::check()) {
            return redirect()->route('dashboard');
        }

        return view('auth.login');
    }

    // Proses login
    public function login(Request $request)
    {
        // Validasi input dari form login
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Mencoba login dengan kredensial yang diberikan
        if (Auth::attempt($credentials, $request->filled('remember'))) {
            // Regenerasi session untuk menghindari session fixation
            $request->session()->regenerate();

            // Mengarahkan ke dashboard setelah login sukses
            return redirect()->intended(route('dashboard'));
        }

        // Jika login gagal, kembali ke halaman login dengan pesan error
        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ])->onlyInput('email');
    }

    // Proses logout
    public function logout(Request $request)
    {
        // Logout user dari aplikasi
        Auth::logout();

        // Hapus session dan generate token baru untuk menjaga keamanan
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Arahkan kembali ke halaman login
        return redirect()->route('login');
    }
}
