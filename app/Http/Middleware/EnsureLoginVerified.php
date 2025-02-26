<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class EnsureLoginVerified
{
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user();

        if ($user) {
            $browser = $request->header('User-Agent');
            $device = $request->ip(); // Bisa ditambahkan pendeteksi perangkat

            $sessionKey = "login_attempt_{$user->id}_{$browser}_{$device}";

            // Cek apakah pengguna sudah memasukkan kode verifikasi
            if (Cache::has($sessionKey)) {
                return redirect()->route('cheaker.account');
            }
        }

        return $next($request);
    }
}
