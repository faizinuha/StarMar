<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewFollowerNotification extends Notification
{
    use Queueable;

    protected $follower;

    /**
     * Create a new notification instance.
     *
     * @param $follower
     */
    public function __construct($follower)
    {
        $this->follower = $follower;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database', 'mail']; // Bisa menggunakan 'mail', 'database', atau lainnya
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->line($this->follower->first_name . ' mulai mengikuti Anda.')
            ->action('Lihat Profil', url('/profile/' . $this->follower->id))
            ->line('Terima kasih telah menggunakan aplikasi kami!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
{
    return [
        'follower_id' => $this->follower->id,
        'follower_name' => $this->follower->first_name, // Pastikan ini mengirimkan first_name
    ];
}

}
