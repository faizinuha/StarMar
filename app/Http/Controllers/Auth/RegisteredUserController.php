<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Notifications\CustomVerifyEmail;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

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
        $request->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'phone' => ['nullable', 'numeric', 'unique:' . User::class],
            'gender' => ['required', 'string'],
            'date' => ['required', 'date'],
            'password' => ['required', 'string', Rules\Password::defaults(), 'confirmed'],
            'g-recaptcha-response' => ['required', 'recaptcha'],
        ]);

        $user = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'phone' => $request->phone,
            'gender' => $request->gender,
            'date' => $request->date,
            'password' => Hash::make($request->password),
        ]);

        // Assign Role Default
        $user->assignRole('user');

        // Kirim email verifikasi
        // $user->sendEmailVerificationNotification();
        // Kirim email verifikasi menggunakan queue
        $user->notify(new CustomVerifyEmail());

        
        // Login User Setelah Registrasi
        Auth::login($user);

        // Redirect ke halaman verifikasi
        return redirect()->route('verification.notice')->with('success', 'Halo ' . $user->first_name . ', silakan verifikasi email Anda!');
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
