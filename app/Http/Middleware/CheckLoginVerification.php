<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Auth;

class CheckLoginVerification
{
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login');
        }

        $sessionKey = "login_verified_{$user->id}";

        if (!session()->has($sessionKey)) {
            return redirect()->route('cheaker.account');
        }

        return $next($request);
    }
}
