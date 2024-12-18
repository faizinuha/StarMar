<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class PasswordResetLinkController extends Controller
{
    /**
     * Menampilkan halaman form permintaan link reset password.
     */
    public function create()
    {
        return view('auth.forgot-password');
    }

    /**
     * Menangani permintaan link reset password.
     */
    public function store(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email'],
        ]);

        // Membuat token reset password
        $token = Str::random(6); // Token reset password 6 karakter

        $email = $request->email;

        // Simpan token di tabel password_resets
        DB::table('password_reset_tokens')->updateOrInsert(
            ['email' => $email],
            ['token' => Hash::make($token), 'created_at' => now()]
        );

        // Kirim email dengan kode reset
        Mail::send('vendor.notifications.reset-code', ['token' => $token], function ($message) use ($email) {
            $message->to($email)->subject('Kode Reset Password');
        });

        return back()->with('status', 'Kode reset telah dikirim ke email Anda.');
    }
   
    /**
     * Menampilkan form reset password dengan token.
     */ 
    public function resetForm($token)
    {
        // Periksa apakah token valid
        $record = DB::table('password_reset_tokens')->where('token', $token)->first();
    
        if (!$record) {
            return redirect()->route('login')->withErrors(['token' => 'Token reset tidak valid atau telah kedaluwarsa.']);
        }
    
        return view('auth.password.confirm', ['token' => $token]);
    }
    

    /**
     * Menangani reset password.
     */
    public function reset(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email'],
            'token' => ['required'],
            'password' => ['required', 'confirmed', 'min:8'],
        ]);

        // Verifikasi token
        $record = DB::table('password_reset_tokens')
            ->where('email', $request->email)
            ->where('token', $request->token)
            ->where('created_at', '>=', now()->subMinutes(15)) // Token valid selama 15 menit
            ->first();

        if (!$record) {
            return back()->withErrors(['token' => 'Kode tidak valid atau telah kedaluwarsa.']);
        }

        // Reset password
        DB::table('users')
            ->where('email', $request->email)
            ->update(['password' => Hash::make($request->password)]);

        // Hapus token setelah digunakan
        DB::table('password_reset_tokens')->where('email', $request->email)->delete();

        return redirect()->route('login')->with('status', 'Password berhasil direset.');
    }
}
