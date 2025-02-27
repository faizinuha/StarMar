<?php

namespace App\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Illuminate\Support\Facades\Mail;
use App\Notifications\NewFollowerNotification;
class Follows extends Component
{

    public $user;
    public $isFollowing;

    public function mount(User $user)
    {
        $this->user = $user;
        $this->isFollowing = $this->checkIsFollowing();
    }


      public function toggleFollow()
    {
        $follower = Auth::user();
    
        if ($this->isFollowing) {
            // unfollow
            $follower->followings()->detach($this->user->id);
        } else {
            // follow
            $follower->followings()->attach($this->user->id);
    
            // Kirim notifikasi kepada pengguna yang di-follow
            $this->user->notify(new NewFollowerNotification($follower));
        }
    
        $this->isFollowing = !$this->isFollowing;
    }
    

    public function checkIsFollowing()
    {
        return Auth::user()->followings()->where('following_id', $this->user->id)->exists();
    }

    public function render()
    {
        return view('livewire.follows');
    }
}