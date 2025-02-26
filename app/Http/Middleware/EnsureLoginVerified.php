<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class EnsureLoginVerified
{
    public function handle($request, Closure $next)
    {
        $user = Auth::user();
        $sessionKey = "login_verified_{$user->id}";
    
        // Jika sudah diverifikasi, lanjutkan akses tanpa perlu kode lagi
        if (Cache::has($sessionKey)) {
            return $next($request);
        }
    
        // Jika belum diverifikasi, arahkan ke halaman input kode
        return redirect()->route('cheaker.account');
    }
    
}
