<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class LoginVerificationController extends Controller
{
    public function showVerificationForm()
    {
        return view('auth.verify_login');
    }

    public function verifyCode(Request $request)
    {
        $request->validate(['code' => 'required|string']);

        $user = Auth::user();
        $verification = DB::table('login_verifications')->where('user_id', $user->id)->first();

        if ($verification && $request->code == $verification->code) {
            // Jika kode cocok, hapus dari database dan buat sesi
            DB::table('login_verifications')->where('user_id', $user->id)->delete();
            session(["login_verified_{$user->id}" => true]);
            
            return redirect()->route('beranda');
        }

        return back()->withErrors(['code' => 'Kode yang dimasukkan salah.']);
    }
}
