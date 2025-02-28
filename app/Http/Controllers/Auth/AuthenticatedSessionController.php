<?php

namespace App\Http\Controllers\Auth;

use Illuminate\View\View;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\Auth\LoginRequest;

class AuthenticatedSessionController extends Controller
{
    /**
     * Menampilkan halaman login.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Proses login pengguna.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        // Pencegahan SQL Injection dengan validasi input
        $credentials = $request->only('email', 'password');

        if (!Auth::attempt($credentials)) {
            return redirect()->route('login')->withErrors(['email' => 'Email atau password salah']);
        }

        $request->session()->regenerate(); // Regenerasi token sesi untuk keamanan

        // Jika pengguna memilih "Remember Me"
        if ($request->remember) {
            Auth::login(Auth::user(), true);
        }
        // Redirect berdasarkan peran pengguna
        if (Auth::user()->hasRole('admin')) {
            return redirect()->route('dashboard');
        } else {
            return redirect()->route('beranda');
        }
    }

    /**
     * Logout pengguna dan hapus sesi.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $user = Auth::user(); // Ambil user yang sedang login

        Auth::logout(); // Logout pengguna

        // Hapus sesi pengguna dari database jika ada
        if ($user) {
            DB::table('sessions')->where('user_id', $user->id)->delete();
        }

        // Bersihkan sesi & token CSRF
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
