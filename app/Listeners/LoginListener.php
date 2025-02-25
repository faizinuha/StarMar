<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Login;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Cache;
use App\Mail\LoginNotificationMail;
use Jenssegers\Agent\Agent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class LoginListener implements ShouldQueue
{
    use InteractsWithQueue;

    public function handle(Login $event)
    {
        $user = $event->user;
        $agent = new Agent();

        $device = $agent->device();
        $browser = $agent->browser();
        $platform = $agent->platform();
        $ip = request()->ip();

        $sessionKey = "login_attempt_{$user->id}_{$browser}_{$device}";

        if (!Cache::has($sessionKey)) {
            $verificationCode = rand(100000, 999999);
            Cache::put($sessionKey, $verificationCode, now()->addMinutes(10));
            Mail::to($user->email)->send(new LoginNotificationMail($user, $browser, $device, $platform, $ip, $verificationCode));
        }
    }
}
