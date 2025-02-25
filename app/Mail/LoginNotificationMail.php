<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class LoginNotificationMail extends Mailable
{
    use Queueable, SerializesModels;

    public $user, $browser, $device, $platform, $ip, $verificationCode;

    public function __construct($user, $browser, $device, $platform, $ip, $verificationCode)
    {
        $this->user = $user;
        $this->browser = $browser;
        $this->device = $device;
        $this->platform = $platform;
        $this->ip = $ip;
        $this->verificationCode = $verificationCode;
    }

    public function build()
    {
        return $this->subject('Peringatan Login Baru')
                    ->view('email.login_notification');
    }
}
