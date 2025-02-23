<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        // Pencegahan SQL Injection dengan validasi input
        $credentials = $request->only('email', 'password');
        
        if (!Auth::attempt($credentials)) {
            return redirect()->route('login')->withErrors(['email' => 'Email atau password salah']);
        }
        
        $request->session()->regenerate(); // Regenerasi token sesi untuk keamanan
        
        if (Auth::user()->hasRole('admin')) {
            return redirect()->route('dashboard');
        } else {
            return redirect()->route('beranda');
        }
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::logout(); // Mengeluarkan pengguna dari sesi
        
        // Catat aktivitas logout pengguna untuk tujuan audit dan keamanan
        DB::table('user_logs')->insert([
            'user_id' => Auth::id(),
            'action' => 'logout',
            'timestamp' => now()
        ]);
        
        $request->session()->invalidate(); // Menghapus sesi saat ini
        $request->session()->regenerateToken(); // Regenerasi token CSRF untuk keamanan

        return redirect()->route('login');
    }
}
