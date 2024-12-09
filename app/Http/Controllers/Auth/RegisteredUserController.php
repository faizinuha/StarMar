<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Notifications\CustomVerifyEmail;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use Spatie\Permission\Models\Role;
class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */

public function store(Request $request): RedirectResponse
{
    $request->validate([
        'first_name' => ['required', 'string', 'max:255'],
        'last_name' => ['required', 'string', 'max:255'],
        'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
        'phone' => ['nullable', 'number', 'unique:' . User::class],
        'gender' => ['required', 'string'],
        'date' => ['required'],
        'password' => ['required', 'string', Rules\Password::defaults(), 'confirmed'],
        'g-recaptcha-response' => 'recaptcha',
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

    // Assign role 'user' setelah pendaftaran
    $user->assignRole('user');  // Bisa ganti 'user' dengan role yang sesuai

    // event(new Registered($user));
    $user->notify(new CustomVerifyEmail());
    Auth::login($user);

    if (Auth::user()->hasVerifiedEmail()) {
        // Jika sudah terverifikasi, arahkan sesuai role
        if (Auth::user()->hasRole('admin')) {
            return redirect()->route('dashboard');
        } else {
            return redirect()->route('beranda');
        }
    }

    // Jika belum memverifikasi email, arahkan ke halaman verifikasi
    return redirect()->route('verification.notice');
}

}