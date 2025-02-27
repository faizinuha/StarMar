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
        $credentials = $request->only('email', 'password');

        if (!Auth::attempt($credentials)) {
            return redirect()->route('login')->withErrors(['email' => 'Email atau password salah']);
        }

        $request->session()->regenerate();

        if (Auth::user()->role === 'admin') {
            return redirect()->route('dashboard');
        } else {
            return redirect()->route('beranda')->with('success', 'Selamat datang, ' . Auth::user()->first_name . '!');
        }
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $user = Auth::user(); // Ambil user yang sedang login
    
        Auth::logout(); // Mengeluarkan pengguna dari sesi
    
        // Hapus sesi pengguna dari database
        if ($user) {
            DB::table('sessions')->where('user_id', $user->id)->delete();
        }
    
        $request->session()->invalidate(); // Menghapus sesi saat ini
        $request->session()->regenerateToken(); // Regenerasi token CSRF untuk keamanan
    
        return redirect()->route('login');
    }    
}
