<div>
    {{-- The whole world belongs to you. --}}
    <h3 class="mt-4">Komentar</h3>
    <form wire:submit.prevent="store" class="mb-4">
        <div class="mb-4">
            <textarea wire:model.defer="body" rows="2" class="form-control" placeholder="Tulis komentar..."></textarea>
        </div>
        <div class="d-grid">
            <button type="submit" class="btn btn-primary">Kirim</button>
        </div>

    </form>
    @foreach ($post->comments as $comment)
        <div class="d-flex align-items-start mb-3">
            <!-- Avatar pengguna -->
            <div class="me-3">
                <img src="/path/to/avatar.jpg" alt="Avatar" class="rounded-circle" style="width: 50px; height: 50px;">
            </div>

            <!-- Konten komentar -->
            <div>
                <!-- Nama pengguna dan tanggal komentar -->
                <div class="mb-1">
                    <strong>{{ $comment->user->first_name }}</strong>
                    <small class="text-muted">{{ $comment->created_at->diffForHumans() }}</small>
                </div>

                <!-- Isi komentar -->
                <p>{{ $comment->content }}</p>

                <!-- Tombol aksi -->
                <div class="d-flex align-items-center">
                    <button wire:click="setReply({{ $comment->id }})" class="btn btn-link p-0">Balas</button>
                    <button class="btn btn-link text-decoration-none text-danger me-2">
                        <i class="bi bi-heart"></i> Like ({{ $comment->likes_count }})
                    </button>
                </div>

                <!-- Form Balas (Muncul Jika Sedang Balas Komentar) -->
                @if ($replyTo === $comment->id)
                    <form wire:submit.prevent="store" class="mt-2">
                        <textarea wire:model.defer="body" rows="2" class="form-control mb-2" placeholder="Tulis balasan..."></textarea>
                        <button type="submit" class="btn btn-sm btn-primary">Kirim</button>
                        <button type="button" wire:click="cancelReply" class="btn btn-sm btn-secondary">Batal</button>
                    </form>
                @endif

                <!-- Balasan komentar -->
                @if ($comment->replies->count())
                    <div class="ms-4 mt-3">
                        @foreach ($comment->replies as $reply)
                            <div class="d-flex align-items-start mb-2">
                                <div class="me-3">
                                    <img src="/path/to/avatar.jpg" alt="Avatar" class="rounded-circle"
                                        style="width: 40px; height: 40px;">
                                </div>
                                <div>
                                    <div class="mb-1">
                                        <strong>{{ $reply->user->name }}</strong>
                                        <small class="text-muted">{{ $reply->created_at->diffForHumans() }}</small>
                                    </div>
                                    <p>{{ $reply->content }}</p>
                                    <button
                                        class="btn btn-link text-decoration-none
                                    {{ $isLiked ? 'text-danger' : 'text-muted' }} me-2"
                                        wire:click="toggleLike({{ $reply->id }})">
                                        <i class="bi bi-heart"></i>Like
                                        ({{ $reply->likes_count }})
                                    </button>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    @endforeach
</div>
