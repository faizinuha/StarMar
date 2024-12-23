<?php

namespace App\Livewire;

use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class PostLike extends Component
{

    public $post;
    public $isLiked;
    public $likesCount;

    public function mount(Post $post)
    {
        $this->post = $post;
        $this->isLiked = $post->likes()->where('user_id', Auth::id())->exists();
        $this->likesCount = $post->likes()->count();
    }

    public function toggleLike()
    {
        if ($this->isLiked) {
            // jika sudah like maka unlike
            $this->post->likes()->detach(Auth::id());
            $this->isLiked = false;
            $this->likesCount--;
        } else {
            // like
            $this->post->likes()->attach(Auth::id());
            $this->isLiked = true;
            $this->likesCount++;
        }
    }

    public function render()
    {
        return view('livewire.post-like');
    }
}