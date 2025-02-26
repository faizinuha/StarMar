<?php

namespace App\Http\Controllers\Auth;

use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Listeners\LoginListener;
use Illuminate\Auth\Events\Login;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\Auth\LoginRequest;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    protected function authenticated(Request $request, $user)
    {
        event(new Login($user));
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $credentials = $request->only('email', 'password');

        if (!Auth::attempt($credentials)) {
            return redirect()->route('login')->withErrors(['email' => 'Email atau password salah']);
        }

        $request->session()->regenerate();

        $user = Auth::user();
        $browser = $request->header('User-Agent');
        $sessionKey = "verified_login_{$user->id}_{$browser}";

        // Jika login dari browser baru, redirect ke halaman verifikasi
        if (!session()->has('verified_device')) {
            return redirect()->route('cheaker.account');
        }

        return $user->hasRole('admin') ? redirect()->route('dashboard') : redirect()->route('beranda');
    }


    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::logout(); // Mengeluarkan pengguna dari sesi

        // Catat aktivitas logout pengguna untuk tujuan audit dan keamanan
        // DB::table('user_logs')->insert([
        //     'user_id' => Auth::id(),
        //     'action' => 'logout',
        //     'timestamp' => now()
        // ]);

        $request->session()->invalidate(); // Menghapus sesi saat ini
        $request->session()->regenerateToken(); // Regenerasi token CSRF untuk keamanan

        return redirect()->route('login');
    }
}
