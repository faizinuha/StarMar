<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Login;
use Illuminate\Support\Facades\Mail;
use App\Mail\LoginNotificationMail;
use Jenssegers\Agent\Agent;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;

class LoginListener
{
    public function handle(Login $event)
    {
        $user = $event->user;
        $agent = new Agent();

        $device = $agent->device();
        $browser = $agent->browser();
        $platform = $agent->platform();
        $ip = request()->ip();

        $sessionKey = "login_verified_{$user->id}";
        $verificationCode = rand(100000, 999999);

        if (!Cache::has($sessionKey)) {
            // Simpan kode verifikasi di database
            DB::table('login_verifications')->updateOrInsert(
                ['user_id' => $user->id],
                ['code' => $verificationCode, 'created_at' => now()]
            );

            // Kirim email notifikasi
            Mail::to($user->email)->send(new LoginNotificationMail($user, $browser, $device, $platform, $ip, $verificationCode));
        }
    }
}
