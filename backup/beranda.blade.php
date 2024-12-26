@extends('users.app')

@push('css')
    @livewireStyles
@endpush
@push('js')
    @livewireScripts
@endpush

@section('content')
    <style>
        .custom-circle {
            margin-bottom: 5px;
            width: 50px;
            height: 50px;
            font-size: 30px;
        }
    </style>
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="main-content right-chat-active">
        <div class="middle-sidebar-bottom">
            <div class="middle-sidebar-left">
                <div class="row feed-body">
                    <div class="col-xl-8 col-xxl-9 col-lg-8">


                        <!-- Form for creating a new post -->
                        {{-- <div class="card w-100 shadow-lg rounded-xxl border-0 ps-4 pt-4 pe-4 pb-3 mb-3">
                            <div class="card-body p-0">
                                <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <p class="font-xssss fw-600 text-grey-500 d-flex align-items-center mb-3">
                                        <i class="btn-round-sm font-xs text-primary feather-edit-3 me-2 bg-greylight"></i>
                                        <span>Create Post</span>
                                    </p>

                                    <textarea name="content"
                                        class="h100 bor-0 w-100 rounded-xxl p-3 ps-5 font-xssss text-grey-500 fw-500 border-light-md theme-dark-bg mb-3"
                                        cols="30" rows="10" placeholder="What's on your mind?">{{ old('content') }}</textarea>

                                    <!-- Uploads: Gambar atau Video - Tempat yang sama -->
                                    <div class="mt-3">
                                        <label class="d-block font-xss fw-600 text-grey-500">Unggah Gambar atau
                                            Video</label>
                                        <div class="d-flex justify-content-between gap-3">
                                            <!-- Gambar Upload -->
                                            <div class="w-48">
                                                <input type="file" name="image"
                                                    class="w-100 p-3 border rounded-3 bg-light" accept="image/*" />
                                                <div class="text-center text-grey-500 mt-2"><i class="feather-image"></i>
                                                    Gambar</div>
                                            </div>
                                            <!-- Video Upload -->
                                            <div class="w-48">
                                                <input type="file" name="live_video"
                                                    class="w-100 p-3 border rounded-3 bg-light" accept="video/*" />
                                                <div class="text-center text-grey-500 mt-2"><i class="feather-video"></i>
                                                    Video</div>
                                            </div>
                                        </div>
                                    </div>

                        
                                    <button type="submit"
                                        class="btn btn-primary mt-3 d-flex align-items-center justify-content-center w-100 p-3 rounded-3 shadow-sm hover-shadow-lg transition-all">
                                        <i class="feather-send me-2"></i> Post
                                    </button>
                                </form>
                            </div>
                        </div> --}}

                        {{-- {{ strtoupper(substr($post->user->first_name, 0, 1)) }} --}}

                        <!-- Display posts -->
                        @foreach ($posts as $post)
                            <div class="card w-100 shadow-sm rounded-xxl border-0 p-3 mb-3">
                                <div class="card-body p-0">
                                    <!-- Profile and Time Section -->
                                    <div class="d-flex align-items-center mb-3">
                                        <a href="{{ route('user.profile', $post->user->id) }}">
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
                                        </a>                                        
                                        <div class="ms-3">
                                            <h6 class="fw-bold text-dark mb-0">{{ $post->user->first_name }}</h6>
                                            <p class="text-muted small mb-0">{{ $post->created_at->diffForHumans() }}</p>
                                        </div>
                                    </div>

                                    <!-- Post Image -->
                                    @if ($post->image)
                                        <div class="mb-4">
                                            <img src="{{ asset('storage/' . $post->image) }}" alt="Post Image"
                                                class="w-100 rounded" style="filter: {{ $post->filter ?? 'none' }};">
                                            @if (Auth::check() && Auth::id() === $post->user_id)
                                                <div class="dropdown position-absolute top-0 end-0 p-2">
                                                    <button class="btn btn-light btn-sm dropdown-toggle" type="button"
                                                        id="postMenu" data-bs-toggle="dropdown" aria-expanded="false">
                                                        <i class="fas fa-ellipsis-v"></i>
                                                    </button>
                                                    <ul class="dropdown-menu" aria-labelledby="postMenu">
                                                        <li><a class="dropdown-item"
                                                                href="{{ route('posts.edit', $post->id) }}">Edit</a></li>
                                                        <li>
                                                            <form action="{{ route('posts.destroy', $post->id) }}"
                                                                method="POST">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit"
                                                                    class="dropdown-item text-danger">Delete</button>
                                                            </form>
                                                        </li>
                                                    </ul>
                                                </div>
                                            @endif
                                            <!-- Menu yang tampil untuk semua pengguna -->
                                            <div class="dropdown position-absolute top-0 end-0 p-2">
                                                <button class="btn btn-light btn-sm dropdown-toggle" type="button"
                                                    id="postMenu" data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="fas fa-ellipsis-v"></i>
                                                </button>
                                                <ul class="dropdown-menu" aria-labelledby="postMenu">
                                                    <li>
                                                        <a class="dropdown-item"
                                                            href="{{ route('report.create', ['type' => 'post', 'id' => $post->id]) }}">
                                                            <i class="fas fa-flag text-warning"></i> Laporkan
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item"
                                                            href="{{ asset('storage/' . $post->image) }}"
                                                            download="{{ $post->content }}.jpg">
                                                            <i class="fas fa-download text-success"></i> Download Gambar
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    @endif

                                    <!-- Post Content -->
                                    <p class="fw-500 text-grey-500 lh-26 font-xsss mb-3">{{ $post->content }}</p>
                                    {{-- @if ($post->hashtags)
                                    <p class="fw-500 text-grey-500 lh-26 font-xsss mb-3">{{ $post->hashtags }}</p>
                                @endif --}}

                                    <!-- Post Interactions -->
                                    <div class="d-flex align-items-center">
                                        <livewire:post-like :post="$post" />

                                        <button type="button" class="btn btn-sm text-muted ms-2" data-bs-toggle="modal"
                                            data-bs-target="#komentar{{ $post->id }}"
                                            wire:click="loadComments({{ $post->id }})">
                                            <i class="feather-message-circle"></i> {{ $post->comments->count() }} Komentar
                                        </button>

                                        <a href="#" class="btn btn-sm text-muted ms-auto">
                                            <i class="feather-share-2"></i> Share
                                        </a>
                                    </div>
                                    {{-- <button type="button" data-bs-toggle="modal"
                                data-bs-target="#komentar{{ $post->id }}"
                                wire:click="loadComments({{ $post->id }})">
                                <i
                                    class="feather-message-circle text-dark text-grey-900 btn-round-sm font-lg"></i>
                                {{ $post->comments->count() }} Komentar
                            </button> --}}

                                    <!-- Comments Modal -->
                                    <div class="modal fade mx-l" id="komentar{{ $post->id }}" tabindex="-1"
                                        aria-labelledby="komentarLabel{{ $post->id }}" aria-hidden="true"
                                        data-bs-backdrop="false" wire:ignore>
                                        <div class="modal-dialog modal-lg modal-dialog-scrollable">
                                            <div class="modal-content">
                                                <div
                                                    class="d-flex align-items-center justify-content-between border-bottom p-3">
                                                    <div class="d-flex align-items-center">
                                                        <img src="{{ asset('storage/' . $post->user->photo_profile) }}"
                                                            alt="Avatar" class="rounded-circle me-2"
                                                            style="width: 40px; height: 40px;">
                                                        <strong>{{ $post->user->first_name }}</strong>
                                                    </div>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body d-flex">
                                                    <!-- Bagian Gambar -->
                                                    <div class="col-md-7 p-0">
                                                        <img src="{{ asset('storage/' . $post->image) }}" alt="Post Image"
                                                            class="w-100 h-100"
                                                            style="object-fit: cover; filter: {{ $post->filter ?? 'none' }};">
                                                        <small>{{ $post->content }}</small>
                                                    </div>
                                                    <!-- Bagian Komentar -->
                                                    <div class="col-md-5 ms-3" style="padding: 30px;">
                                                        @livewire('posts.comment', ['postId' => $post->id])
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        <!-- Loading spinner if needed -->
                        <div class="card w-100 text-center shadow-xss rounded-xxl border-0 p-4 mb-3 mt-3">
                            <div class="snippet mt-2 ms-auto me-auto" data-title=".dot-typing">
                                <div class="stage">
                                    <div class="dot-typing"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- RIGHT MENU --}}
                    @include('users.components.right-menu')
                </div>
            </div>
        </div>
    </div>







    <script src="{{ asset('js/comment.js') }}"></script>
    <script src="{{ asset('js/bagikan.js') }}"></script>
    <script src="{{ asset('js/like.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
        integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous">
    </script>

    <style>
        .hidden {
            display: none;
        }

        .read-more {
            cursor: pointer;
        }

        .like-button.liked i {
            color: red;
        }

        .like-button {
            display: inline-flex;
            align-items: center;
            margin-right: 1px;
        }

        .like-count {
            font-size: 14px;
            color: #888;
            margin-left: 1px;
            vertical-align: middle;
        }

        .custom-modal .modal-backdrop {
            background-color: rgba(0, 0, 0, 0.1);
        }
    </style>

    <script>
        document.querySelectorAll('.image-video-preview').forEach(function(element) {
            element.addEventListener('click', function() {
                const imageOrVideo = element.querySelector('img') || element.querySelector('video');
                if (imageOrVideo) {
                    // Open modal for creating post
                    $('#modal-create-post').modal('show');
                }
            });
        });

        document.getElementById('live-video-btn').addEventListener('click', function() {
            alert('Live Video option is not available yet!');
        });
    </script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const likeButtons = document.querySelectorAll('.like-button');

            likeButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const postId = this.dataset.postId;
                    const likeCountElement = this.querySelector(
                        '.like-count'); // Get the like count element within the button
                    const isLiked = this.classList.contains('liked'); // Check if the post is liked

                    fetch('/like', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector(
                                    'meta[name="csrf-token"]').getAttribute('content')
                            },
                            body: JSON.stringify({
                                post_id: postId,
                                action: isLiked ? 'unlike' :
                                    'like' // Toggle action based on the current state
                            })
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.status === 'liked') {
                                this.classList.add('liked');
                            } else if (data.status === 'unliked') {
                                this.classList.remove('liked');
                            }
                            // Update the like count
                            likeCountElement.textContent = `${data.like_count} Like`;
                        })
                        .catch(error => console.error('Error:', error));
                });
            });
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const commentPopup = document.getElementById('commentPopup');
            const btnComment = document.querySelector('.btn-comment');
            const closePopup = document.getElementById('closePopup');

            // Event untuk membuka popup
            btnComment.addEventListener('click', () => {
                commentPopup.classList.remove('hidden');
            });

            // Event untuk menutup popup
            closePopup.addEventListener('click', () => {
                commentPopup.classList.add('hidden');
            });
        });
    </script>

    <script>
        document.addEventListener('livewire:load', function() {
            Livewire.on('openModal', () => {
                const modal = new bootstrap.Modal(document.getElementById('komentar'));
                modal.show();
            });
        });
    </script>
@endsection
