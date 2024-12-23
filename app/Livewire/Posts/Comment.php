<?php

namespace App\Livewire\Posts;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\Comment as ModelsComment;

class Comment extends Component
{
    public $post_id;
    public $comments = [];
    public $replyTo = null;
    public $body;

    // Fungsi mount akan dipanggil saat komponen Livewire diinisialisasi
    public function mount($postId)
    {
        $this->post_id = $postId;
        $this->loadComments($postId);
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
        $this->loadComments($this->post_id);
    }

    public function toggleLike($commentId)
    {
        $comment = ModelsComment::findOrFail($commentId);
        $userId = Auth::id();

        $existingLike = $comment->likes()->where('user_id', $userId)->first();

        if ($existingLike) {
            $existingLike->delete(); // Unlike
        } else {
            $comment->likes()->create(['user_id' => $userId]); // Like
        }

        // Perbarui komentar untuk ditampilkan
        $this->loadComments($this->post_id);
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
        return view('livewire.posts.comment', [
            'comments' => $this->comments,
        ]);
    }

    public function loadComments($postId)
    {
        $this->comments = ModelsComment::where('post_id', $postId)
            ->with(['replies.replies', 'user', 'likes'])
            ->whereNull('parent_id')
            ->get();
    }
}
