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

        .owl-carousel {
            display: inline-block
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

                        <div class="card w-100 shadow-none bg-transparent bg-transparent-card border-0 p-0 mb-0">
                            <div class="owl-carousel category-card owl-theme overflow-hidden nav-none d-flex flex-row">
                                @if (!isset($groupedStories[auth()->id()]))
                                    <div class="item">
                                        <button type="button" class="cursor-pointer border-0 bg-transparent" data-bs-toggle="modal"
                                            data-bs-target="#addStoryModal">
                                            <div
                                                class="card w125 h200 d-block border-0 shadow-none rounded-xxxl bg-dark overflow-hidden mb-3 mt-3">
                                                <div class="card-body d-block p-3 w-100 position-absolute bottom-0 text-center">
                                                    <span class="btn-round-lg bg-white"><i class="feather-plus font-lg"></i></span>
                                                    <h4 class="fw-700 position-relative z-index-1 ls-1 font-xssss text-white mt-2 mb-1">
                                                        Add Story</h4>
                                                </div>
                                            </div>
                                        </button>
                                    </div>
                                @endif
                        
                                @foreach ($groupedStories as $userStories)
                                    @foreach ($userStories as $story)
                                        <div class="item d-flex">
                                            <div class="card w125 h200 d-block border-0 shadow-xss rounded-xxxl overflow-hidden cursor-pointer mb-3 mt-3"
                                                style="background-image: url({{ asset('storage/' . $story->media) }});"
                                                data-id="{{ $story->id }}" onclick="viewStory(this)">
                                                <div class="card-body d-block p-3 w-100 position-absolute bottom-0 text-center">
                                                    <figure class="avatar ms-auto me-auto mb-0 position-relative w50 z-index-1">
                                                        <img src="{{ asset('storage/' . $story->user->photo_profile) }}" alt="image"
                                                            class="float-right p-0 bg-white rounded-circle w-100 shadow-xss">
                                                    </figure>
                                                    <h4
                                                        class="fw-600 position-relative z-index-1 ls-1 font-xssss text-white mt-2 mb-1">
                                                        {{ $story->user->first_name }}
                                                    </h4>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @endforeach
                            </div>
                        </div>
                        
                        

                        {{-- show story --}}
                        <div class="modal fade" id="storyModal" tabindex="-1" aria-labelledby="storyModalLabel"
                            aria-hidden="true" data-bs-backdrop="false">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <!-- Progress bar -->
                                    <div class="progress w-100" style="height: 5px;">
                                        <div class="progress-bar" id="storyProgressBar" role="progressbar"
                                            style="width: 0%;"></div>
                                    </div>
                                    <!-- Story content -->
                                    <div class="modal-body p-0" id="storyModalContent">
                                        <!-- Media content will be dynamically loaded -->
                                    </div>
                                </div>
                            </div>
                        </div>




                        {{-- modal add --}}
                        <div class="modal fade mx-l" id="addStoryModal" tabindex="-1" aria-labelledby="addStoryModalLabel"
                            aria-hidden="true" data-bs-backdrop="false">
                            <div class="modal-dialog modal-lg modal-dialog-scrollable">
                                <!-- Tambahkan kelas modal-lg atau modal-xl -->
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="addStoryModalLabel">Add Story</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{ route('stories.store') }}" method="POST"
                                            enctype="multipart/form-data">
                                            @csrf
                                            <div class="mb-3">
                                                <label for="media" class="form-label">Select Media</label>
                                                <input type="file" name="media" id="media" class="form-control"
                                                    accept="image/*,video/*" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="description" class="form-label">Caption
                                                    (Optional)</label>
                                                <textarea name="description" id="description" class="form-control" rows="3"></textarea>
                                            </div>
                                            <div class="d-flex justify-content-end">
                                                <button type="submit" class="btn btn-primary">Upload
                                                    Story</button>
                                                <button type="button" class="btn btn-secondary ms-2"
                                                    data-bs-dismiss="modal">Cancel</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>



                        <!-- Display posts -->
                        @foreach ($posts as $post)
                            <div class="card w-100 shadow-sm rounded-xxl border-0 p-3 mb-3">
                                <div class="card-body p-0">
                                    <!-- Profile and Time Section -->
                                    <div class="d-flex align-items-center mb-3">
                                        <a href="{{ route('user.profile', $post->user->id) }}">
                                            <div
                                                class="custom-circle bg-info text-white rounded-circle d-flex align-items-center justify-content-center font-weight-bold">
                                                @php
                                                    $photoPath = $post->user->photo_profile; // Path foto profil pengguna yang terkait dengan post
                                                    $photoExists =
                                                        $photoPath && file_exists(public_path('storage/' . $photoPath)); // Cek dengan file_exists
                                                @endphp
                                                @if ($photoExists)
                                                    <img src="{{ asset('storage/' . $photoPath) }}" alt="image"
                                                        class="shadow-sm rounded-circle w50">
                                                @else
                                                    <img src="{{ asset('users/avatar.png') }}" alt="image"
                                                        class="shadow-sm rounded-circle w50">
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
                                    @if ($post->video)
                                    <div class="mb-4">
                                    <video src="{{asset('storage/' . $post->video)}}">
                                        
                                    </video>
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
                                                        <img src="{{ asset('storage/' . $post->image) }}"
                                                            alt="Post Image" class="w-100 h-100"
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

    <script>
        document.addEventListener('livewire:load', function() {
            Livewire.on('openModal', () => {
                const modal = new bootstrap.Modal(document.getElementById('komentar'));
                modal.show();
            });
        });
    </script>

    <script src="path/to/jquery.min.js"></script>
    <script src="path/to/owl.carousel.min.js"></script>
    <script>
        $(document).ready(function() {
            $(".owl-carousel").owlCarousel({
                loop: true, // Mengulang carousel
                margin: 10, // Jarak antar item
                nav: false, // Tombol navigasi
                responsive: {
                    0: {
                        items: 2 // Jumlah item pada layar kecil
                    },
                    600: {
                        items: 3 // Jumlah item pada layar sedang
                    },
                    1000: {
                        items: 5 // Jumlah item pada layar besar
                    }
                }
            });
        });
    </script>

    <script>
        let progressInterval; // To store the progress interval timer

        function viewStory(element) {
            const storyId = element.getAttribute('data-id');
            const modalContent = document.getElementById('storyModalContent');
            const progressBar = document.getElementById('storyProgressBar');

            // Reset progress bar
            progressBar.style.width = '0%';

            // Fetch story details
            fetch(`/stories/${storyId}`)
                .then(response => response.json())
                .then(data => {
                    // Clear existing interval if any
                    clearInterval(progressInterval);

                    // Determine duration
                    let duration = 15000; // Default 30 seconds for images
                    if (data.media.endsWith('.mp4') || data.media.endsWith('.mov')) {
                        duration = 60000; // 60 seconds for videos
                    }

                    // Load media content
                    if (data.media.endsWith('.mp4') || data.media.endsWith('.mov')) {
                        modalContent.innerHTML = `
                    <video controls autoplay muted class="w-100 h-auto">
                        <source src="/storage/${data.media}" type="video/mp4">
                        Your browser does not support the video tag.
                    </video>
                `;
                    } else {
                        modalContent.innerHTML = `
                    <img src="/storage/${data.media}" alt="story" class="w-100 h-auto">
                `;
                    }

                    // Start progress bar
                    let progress = 0;
                    progressInterval = setInterval(() => {
                        progress += 100 / (duration / 100); // Increase progress in steps
                        progressBar.style.width = `${progress}%`;

                        if (progress >= 100) {
                            clearInterval(progressInterval); // Stop progress when complete
                            closeStoryModal(); // Close modal automatically
                        }
                    }, 100);

                    // Show modal
                    const storyModal = new bootstrap.Modal(document.getElementById('storyModal'));
                    storyModal.show();
                })
                .catch(error => console.error('Error fetching story:', error));
        }

        function closeStoryModal() {
            const storyModal = bootstrap.Modal.getInstance(document.getElementById('storyModal'));
            storyModal.hide();
            clearInterval(progressInterval); // Clear interval when modal is closed
        }
    </script>
@endsection
