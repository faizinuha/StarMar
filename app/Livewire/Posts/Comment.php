<?php

namespace App\Livewire\Posts;

use App\Models\Comment as ModelsComment;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Comment extends Component
{

    public $post_id;
    public $replyTo = null;
    public $isLiked = false;
    public $body;

    // Fungsi mount akan dipanggil saat komponen Livewire diinisialisasi
    public function mount($postId)
    {
        $this->post_id = $postId; // Set nilai post_id dari parameter mount
    }

    public function store()
    {
        $this->validate(['body' => 'required|min:1|max:300']);

        ModelsComment::create([
            'post_id' => $this->post_id,
            'user_id' => auth()->id(),
            'content' => $this->body,
            'parent_id' => $this->replyTo
        ]);

        $this->reset('body', 'replyTo');
    }

    public function toggleLike($commentId)
    {
        $comment = ModelsComment::findOrFail($commentId);
        $userId = Auth::id();

        $existingLike = $comment->likes()->where('user_id', $userId)->first();
        if ($existingLike) {
            $existingLike->delete(); // Unlike
            $this->isLiked = false;
        } else {
            $comment->likes()->create(['user_id' => $userId]); // Like
            $this->isLiked = true;
        }
    }

    public function setReply($commentId)
    {
        $this->replyTo = $commentId;
    }

    public function cancelReply()
    {
        $this->replyTo = null;
    }

    public function render()
    {
        $post = Post::with('comments.user')->findOrFail($this->post_id);

        foreach ($post->comments as $comment) {
            $comment->isLiked = $comment->likes()->where('user_id', Auth::id())->exists();
        }

        return view('livewire.posts.comment', compact('post'));
    }
}