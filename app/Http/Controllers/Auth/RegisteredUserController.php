<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Notifications\CustomVerifyEmail;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use Exception;

class RegisteredUserController extends Controller
{
    protected $redirectTo = 'verify-email'; // Ubah ke URL halaman verifikasi

    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     */
    public function store(Request $request): RedirectResponse
    {
        try {
            $validated = $request->validate([
                'first_name' => ['required', 'string', 'max:255'],
                'last_name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:users,email'],
                'phone' => ['nullable', 'numeric', 'unique:users,phone'],
                'gender' => ['required', 'string'],
                'date' => ['required', 'date'],
                'password' => ['required', 'string', Rules\Password::defaults(), 'confirmed'],
                'g-recaptcha-response' => ['required', 'recaptcha'],
            ]);

            $user = User::create([
                'first_name' => $validated['first_name'],
                'last_name' => $validated['last_name'],
                'email' => $validated['email'],
                'phone' => $validated['phone'] ?? null,
                'gender' => $validated['gender'],
                'date' => $validated['date'],
                'password' => Hash::make($validated['password']),
            ]);

            // Assign Role Default
            $user->assignRole('user');

            // Kirim email verifikasi
            $user->notify(new CustomVerifyEmail());

            // Login User Setelah Registrasi
            Auth::login($user);

            // Redirect ke halaman verifikasi
            return redirect()->route('verification.notice')->with('success', 'Halo ' . $user->first_name . ', silakan verifikasi email Anda!');
        } catch (Exception $e) {
            Log::error('Registrasi gagal: ' . $e->getMessage());
            return redirect()->route('register')->withErrors(['error' => 'Terjadi kesalahan saat mendaftar. Silakan coba lagi.']);
        }
    }

    protected function registered(Request $request, $user)
    {
        session()->flash(
            'notification',
            __("Wah, selamat datang :name! Terima kasih telah mendaftar di aplikasi kami. Silakan verifikasi email Anda untuk melanjutkan.", [
                'name' => $user->name ?? $user->first_name
            ])
        );
    }
}
