<?php
namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class FollowNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $follower;
    public $user;

    public function __construct(User $follower, User $user)
    {
        $this->follower = $follower;
        $this->user = $user;
    }

    public function build()
    {
        return $this->subject('You have a new follower!')
                    ->view('email');
    }
}
