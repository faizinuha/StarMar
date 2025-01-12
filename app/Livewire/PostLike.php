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
        $userId = Auth::id();
    
        // Proses Async
        dispatch(function () use ($userId) {
            if ($this->isLiked) {
                $this->post->likes()->detach($userId);
            } else {
                $this->post->likes()->attach($userId);
            }
        });
    
        // Update UI Lokal
        $this->isLiked = !$this->isLiked;
        $this->likesCount += $this->isLiked ? 1 : -1;
    }
    

    public function render()
    {
        return view('livewire.post-like');
    }
}