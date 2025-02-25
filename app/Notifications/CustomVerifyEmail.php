<?php

namespace App\Notifications;

use Illuminate\Auth\Notifications\VerifyEmail as BaseVerifyEmail;
use Illuminate\Notifications\Messages\MailMessage;

class CustomVerifyEmail extends BaseVerifyEmail
{
    
    public function toMail($notifiable)
    {
        $url = $this->verificationUrl($notifiable);
    
        return (new MailMessage)
            ->subject('Verifikasi Email Anda')
            ->greeting('Halo ' . $notifiable->first_name . '!')
            ->line('Terima kasih telah bergabung! Klik tombol di bawah untuk memverifikasi email Anda.')
            ->action('Verifikasi Email', $url)
            ->line('Jika Anda tidak mendaftar, abaikan email ini.');
    }
    
}
