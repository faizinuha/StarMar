<?php

namespace App\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

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
        if ($this->isFollowing) {
            // unfollow
            Auth::user()->followings()->detach($this->user->id);
        } else {
            // follow
            Auth::user()->followings()->attach($this->user->id);
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