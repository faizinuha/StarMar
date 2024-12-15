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
    <div class="main-content right-chat-active">
        <div class="middle-sidebar-bottom">
            <div class="middle-sidebar-left">
                <div class="row feed-body">
                    <div class="col-xl-8 col-xxl-9 col-lg-8">
                        @if (Auth::user() && !Auth::user()->hasVerifiedEmail())
                            <div class="alert alert-warning">
                                Silakan verifikasi email Anda untuk melanjutkan.
                                <form method="POST" action="{{ route('verification.send') }}">
                                    @csrf
                                    <button type="submit"
                                        class="btn btn-primary w-full bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                                        Kirim Ulang Tautan
                                    </button>
                                </form>
                            </div>
                        @endif

                        <!-- Form for creating a new post -->
                        <div class="card w-100 shadow-lg rounded-xxl border-0 ps-4 pt-4 pe-4 pb-3 mb-3">
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

                                    <!-- Bagian Go Live Video -->
                                    {{-- <div class="mt-3">
                                        <label class="d-block font-xss fw-600 text-grey-500 mb-2">Live Video
                                            Broadcast</label>
                                        <button type="button"
                                            class="btn btn-outline-primary w-100 d-flex align-items-center justify-content-center p-3 rounded-3 shadow-sm hover-shadow-lg transition-all"
                                            id="live-video-btn">
                                            <i class="feather-video me-2"></i> Go Live
                                        </button>
                                    </div> --}}

                                    <button type="submit"
                                        class="btn btn-primary mt-3 d-flex align-items-center justify-content-center w-100 p-3 rounded-3 shadow-sm hover-shadow-lg transition-all">
                                        <i class="feather-send me-2"></i> Post
                                    </button>
                                </form>
                            </div>
                        </div>


                        <!-- Display posts -->
                        @foreach ($posts as $post)
                            <div class="card w-100 shadow-xss rounded-xxl border-0 ps-4 pt-4 pe-4 pb-3 mb-3">
                                <div class="card-body p-0">
                                    <!-- Profile and time section -->


                                    <div class="d-flex align-items-center">
                                        <!-- Link ke profil pengguna -->
                                        <a href="{{ route('user.profile', $post->user->id) }}">
                                            <div
                                                class="custom-circle bg-info text-white rounded-circle d-flex align-items-center justify-content-center font-weight-bold">
                                                {{ strtoupper(substr($post->user->first_name, 0, 1)) }}
                                            </div>
                                        </a>
                                        <!-- User Info -->
                                        <div class="ms-3">
                                            <h6 class="font-weight-semibold text-dark mb-0">
                                                {{ $post->user->first_name }}
                                            </h6>
                                            <p class="text-muted small mb-0">
                                                {{ $post->created_at->diffForHumans() }}</p>
                                        </div>
                                    </div>


                                    @if ($post->image)
                                        <div class="mb-4 relative">
                                            <img src="{{ asset('storage/' . $post->image) }}" alt="Post Image"
                                                class="mb-4" style="filter: {{ $post->filter ?? 'none' }};">
                                            @if (Auth::id() === $post->user_id)
                                                <a href="{{ route('posts.edit', $post->id) }}"
                                                    class="absolute top-0 right-0 p-2 bg-white rounded-full shadow-md hover:bg-gray-200">
                                                    <i class="fas fa-edit text-xl text-gray-600"></i>
                                                </a>
                                                <form action="{{ route('posts.destroy', $post->id) }}" method="POST"
                                                    class="absolute top-0 right-10 p-2 bg-white rounded-full shadow-md hover:bg-gray-200">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="text-xl text-red-600">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            @endif
                                        </div>
                                    @endif



                                    <!-- Post content -->
                                    <div class="card-body p-0">
                                        <p class="fw-500 text-grey-500 lh-26 font-xssss w-100 mb-2">
                                            {{ $post->content }}</p>
                                    </div>

                                    <!-- Post interactions -->
                                    <div class="card-body d-flex p-0">
                                        @php
                                            $isLiked = $post->likedByUsers->contains(auth()->id());
                                        @endphp

                                        <button class="like-button {{ $isLiked ? 'liked' : '' }}"
                                            data-post-id="{{ $post->id }}">
                                            <i class="fas fa-heart"></i> <span
                                                class="like-count">{{ $post->likedByUsers->count() }}</span>
                                        </button>


                                        <a href="#"
                                            class="emoji-bttn d-flex align-items-center fw-600 text-grey-900 text-dark lh-26 font-xssss me-2">
                                            <i
                                                class="feather-thumbs-up text-white bg-primary-gradiant me-1 btn-round-xs font-xss"></i>
                                            <i
                                                class="feather-heart text-white bg-red-gradiant me-2 btn-round-xs font-xss"></i>{{ $post->likedByUsers->count() }}
                                            Like
                                        </a>

                                        <i class="feather-message-circle text-dark text-grey-900 btn-round-sm font-lg"></i>
                                        <span>{{ $post->comments->count() }} Comment</span>




                                        <a href="#"
                                            class="ms-auto d-flex align-items-center fw-600 text-grey-900 text-dark lh-26 font-xssss">
                                            <i
                                                class="feather-share-2 text-grey-900 text-dark btn-round-sm font-lg"></i><span
                                                class="d-none-xs">Share</span>
                                        </a>
                                    </div>
                                    @livewire('posts.comment', ['postId' => $post->id])
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
                </div>
            </div>
        </div>
    </div>


    <script src="{{ asset('js/comment.js') }}"></script>
    <script src="{{ asset('js/bagikan.js') }}"></script>
    <script src="{{ asset('js/like.js') }}"></script>

    <!-- CSS -->
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
        // Fungsi untuk menampilkan/menyembunyikan form balas komentar
        function toggleReplyForm(commentId) {
            const replyForm = document.getElementById(`reply-form-${commentId}`);
            if (replyForm.style.display === 'none') {
                replyForm.style.display = 'block';
            } else {
                replyForm.style.display = 'none';
            }
        }
    </script>
@endsection
