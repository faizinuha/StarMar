{{-- <a href="{{ route('user.profile', $post->user->id) }}">
    <div class="custom-circle bg-info text-white rounded-circle d-flex align-items-center justify-content-center font-weight-bold">
        @php
            $photoPath = $post->user->photo_profile; // Path foto profil pengguna yang terkait dengan post
            $photoExists = $photoPath && file_exists(public_path('storage/' . $photoPath)); // Cek dengan file_exists
        @endphp
        @if ($photoExists)
            <img src="{{ asset('storage/' . $photoPath) }}" alt="image" class="shadow-sm rounded-circle w50">
        @else
            <img src="{{ asset('users/avatar.png') }}" alt="image" class="shadow-sm rounded-circle w50">
        @endif
    </div>
</a> --}}

<div>
    @foreach ($comments as $comment)
        <div class="d-flex align-items-start mb-3">
            <div class="me-3">
                @if ($comment->user->photo_profile)
                    <img src="{{ asset('storage/' . $comment->user->photo_profile) }}" alt="Avatar"
                        class="rounded-circle" style="width: 50px; height: 50px;">
                @else
                    <img src="{{ asset('users/avatar.png') }}" alt="Avatar" class="rounded-circle"
                        style="width: 50px; height: 50px;">
                @endif
            </div>
            <div>
                <div class="mb-1">
                    <strong>{{ $comment->user->first_name }}</strong>
                    <small class="text-muted">{{ $comment->created_at->diffForHumans() }}</small>
                </div>
                <p>{{ $comment->content }}</p>
                <div class="d-flex align-items-center">
                    <button wire:click="setReply({{ $comment->id }})" class="btn btn-link p-0">Balas</button>
                    <button wire:click="toggleLike({{ $comment->id }})" class="d-flex align-items-center space-x-1">
                        @php
                            $isLiked = $comment->likes->contains('user_id', auth()->id());
                        @endphp

                        @if ($isLiked)
                            <svg xmlns="http://www.w3.org/2000/svg" fill="red" viewBox="0 0 24 24" stroke="none"
                                class="w-6 h-6">
                                <path
                                    d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z" />
                            </svg>
                        @else
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M12.1 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54l-1.45 1.31z" />
                            </svg>
                        @endif
                        <span>{{ $comment->likes->count() }}</span>
                    </button>
                </div>
                @if ($replyTo === $comment->id)
                    <form wire:submit.prevent="store" class="mt-2">
                        <input type="text" wire:model.defer="body" class="form-control mb-2"
                            placeholder="Tulis balasan...">
                        <button type="submit" class="btn btn-sm btn-primary">Kirim</button>
                        <button type="button" wire:click="cancelReply" class="btn btn-sm btn-secondary">Batal</button>
                    </form>
                @endif
                @if ($comment->replies->count())
                    <div class="ms-4 mt-3">
                        @foreach ($comment->replies as $reply)
                            <div class="d-flex align-items-start mb-2">
                                <div class="me-3">
                                   @if ($reply->user->photo_profile)
                                        <img src="{{ asset('storage/' . $reply->user->photo_profile) }}" alt="Avatar"
                                            class="rounded-circle" style="width: 50px; height: 50px;">
                                    @else
                                        <img src="{{ asset('users/avatar.png') }}" alt="Avatar" class="rounded-circle"
                                            style="width: 50px; height: 50px;">     
                                   @endif
                                </div>
                                <div>
                                    <div class="mb-1">
                                        <strong>{{ $reply->user->first_name }}</strong>
                                        <small
                                            class="text-muted">{{ $reply->created_at->diffForHumans() }}</small>
                                    </div>
                                    <p>{{ $reply->content }}</p>
                                    <button wire:click="toggleLike({{ $reply->id }})"
                                        class="d-flex align-items-center">
                                        @php
                                            $isLikedReply = $reply->likes->contains('user_id', auth()->id());
                                        @endphp
                                        @if ($isLikedReply)
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="red" viewBox="0 0 24 24"
                                                stroke="none" class="w-6 h-6">
                                                <path
                                                    d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z" />
                                            </svg>
                                        @else
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke="currentColor" class="w-6 h-6">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                                    d="M12.1 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54l-1.45 1.31z" />
                                            </svg>
                                        @endif
                                        <span>{{ $reply->likes->count() }}</span>
                                    </button>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    @endforeach
    <h3 class="mt-4">Komentar</h3>
    <form wire:submit.prevent="store" class="mb-4">
        <div class="mb-4">
            <input type="text" wire:model.defer="body" class="form-control"
                placeholder="Tulis komentar...">
        </div>
        <div class="d-grid">
            <button type="submit" class="btn btn-primary">Kirim</button>
        </div>
    </form>
</div>
