<?php

namespace App\Notifications;

use Illuminate\Auth\Notifications\VerifyEmail as BaseVerifyEmail;
use Illuminate\Notifications\Messages\MailMessage;

class CustomVerifyEmail extends BaseVerifyEmail
{
    /**
     * Get the email representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->subject(__('notifications.verification.subject'))
                    ->greeting(__('notifications.verification.greeting', ['name' => $notifiable->name]))
                    ->line(__('notifications.verification.intro'))
                    ->action(__('notifications.verification.button'), $this->verificationUrl($notifiable))
                    ->line(__('notifications.verification.outro'))
                    ->salutation(__('notifications.verification.thank_you'));
    }
}
