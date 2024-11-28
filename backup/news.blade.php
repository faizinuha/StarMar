<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>StarMar</title>

    <link rel="stylesheet" href="{{ asset('dist2/css/themify-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('dist2/css/feather.css') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('dist2/images/favicon.png') }}">
    <link rel="stylesheet" href="{{ asset('dist2/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('dist2/css/emoji.css') }}">
    <link rel="stylesheet" href="{{ asset('dist2/css/lightbox.css') }}">
</head>

<body class="color-theme-blue mont-font">
    <style>
        .custom-circle {
            margin-bottom: 5px;
            width: 50px;
            height: 50px;
            font-size: 30px;
        }

        /* Ubah opacity backdrop modal */
        .modal-backdrop {
            background-color: rgba(0, 0, 0, 0.5);
            /* Ganti angka 0.5 dengan nilai transparansi yang diinginkan */
        }

        /* Ubah backdrop menjadi lebih terang atau gelap sesuai preferensi */
        .modal-backdrop.show {
            background-color: rgba(0, 0, 0, 0.3);
            /* Semakin rendah angka, semakin transparan */
        }
    </style>
    <div class="preloader"></div>

    <div class="main-wrapper">

        <!-- Navigation -->
        @include('users.components.navbar')
        @include('users.components.navleft')

        <!-- Main content -->
        <div class="main-content right-chat-active">
            <div class="middle-sidebar-bottom">
                <div class="middle-sidebar-left">
                    <div class="row feed-body">
                        <div class="col-xl-8 col-xxl-9 col-lg-8">

                            <!-- Form for creating a new post -->
                            <div class="card w-100 shadow-xss rounded-xxl border-0 ps-4 pt-4 pe-4 pb-3 mb-3">
                                <div class="card-body p-0">
                                    <form action="{{ route('posts.store') }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <p
                                            class="font-xssss fw-600 text-grey-500 card-body p-0 d-flex align-items-center">
                                            <i
                                                class="btn-round-sm font-xs text-primary feather-edit-3 me-2 bg-greylight"></i>
                                            <span>Create Post</span>
                                        </p>

                                        <textarea name="content"
                                            class="h100 bor-0 w-100 rounded-xxl p-2 ps-5 font-xssss text-grey-500 fw-500 border-light-md theme-dark-bg"
                                            cols="30" rows="10" placeholder="What's on your mind?">{{ old('content') }}</textarea>

                                        <!-- Upload Image or Video -->
                                        <div class="mt-3 d-flex justify-content-between align-items-center">
                                            <div class="upload-container w-48">
                                                <label class="d-block font-xss fw-600 text-grey-500 text-center">
                                                    <div class="upload-icon-container p-4 rounded border text-grey-500"
                                                        style="cursor: pointer;" data-bs-toggle="modal"
                                                        data-bs-target="#imageVideoModal">
                                                        <i class="feather-camera font-lg"></i> <br>
                                                        <span>Upload Photo/Video</span>
                                                    </div>
                                                </label>
                                                <input type="file" name="image" id="image-video" class="d-none"
                                                    accept="image/*, video/*" />
                                            </div>

                                            <!-- Go Live button -->
                                            <div class="w-48">
                                                <button type="button"
                                                    class="btn btn-outline-secondary w-100 d-flex align-items-center justify-content-center"
                                                    id="live-video-btn">
                                                    <i class="feather-video me-2"></i> Go Live
                                                </button>
                                            </div>
                                        </div>

                                        <button type="submit"
                                            class="btn btn-primary mt-3 d-flex align-items-center justify-content-center w-100">
                                            <i class="feather-send me-2"></i> Post
                                        </button>
                                    </form>
                                </div>
                            </div>

                            <!-- Modal for Image/Video Upload -->
                            <div class="modal fade" id="imageVideoModal" tabindex="-1" role="dialog"
                                aria-labelledby="imageVideoModalLabel" aria-hidden="true" data-bs-backdrop="false">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="imageVideoModalLabel">Choose Image or Video</h5>
                                            <button type="button" class="close" data-bs-dismiss="modal"
                                                aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="d-flex justify-content-between">
                                                <!-- Choose Image -->
                                                <button type="button" class="btn btn-outline-primary w-48"
                                                    id="chooseImageBtn">
                                                    <i class="feather-image"></i> Choose Image
                                                </button>

                                                <!-- Choose Video -->
                                                <button type="button" class="btn btn-outline-primary w-48"
                                                    id="chooseVideoBtn">
                                                    <i class="feather-video"></i> Choose Video
                                                </button>
                                            </div>

                                            <!-- Content Section -->
                                            <div class="mt-3">
                                                <label for="postContent" class="font-xss fw-600 text-grey-500">What's on
                                                    your mind?</label>
                                                <textarea id="postContent" name="content" class="w-100 border rounded" rows="3" placeholder="Write something..."></textarea>
                                            </div>

                                            <!-- Preview selected Image or Video -->
                                            <div id="filePreview" class="mt-3">
                                                <img id="imagePreview"
                                                    style="display:none; width: 100%; max-height: 300px;" />
                                                <video id="videoPreview"
                                                    style="display:none; width: 100%; max-height: 300px;" controls>
                                                    <source id="videoSource" />
                                                </video>
                                            </div>

                                            <!-- Hidden Input for Image and Video -->
                                            <input type="file" name="image" id="imageInput"
                                                style="display: none;" accept="image/*" />
                                            <input type="file" name="video" id="videoInput"
                                                style="display: none;" accept="video/*" />

                                            <!-- Post Button -->
                                            <div class="mt-3 text-center">
                                                <button type="submit" id="postBtn" class="btn btn-primary w-100"
                                                    >Post</button>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Scripts for Modal Functionality -->
                            <script>
                                document.getElementById('chooseImageBtn').addEventListener('click', function() {
                                    let imageInput = document.getElementById('imageInput');
                                    imageInput.click();

                                    imageInput.addEventListener('change', function() {
                                        if (imageInput.files && imageInput.files[0]) {
                                            const reader = new FileReader();
                                            reader.onload = function(e) {
                                                document.getElementById('imagePreview').style.display = 'block';
                                                document.getElementById('imagePreview').src = e.target.result;
                                                document.getElementById('videoPreview').style.display = 'none';
                                                document.getElementById('postBtn').disabled = false;
                                            };
                                            reader.readAsDataURL(imageInput.files[0]);
                                        }
                                    });
                                });

                                document.getElementById('chooseVideoBtn').addEventListener('click', function() {
                                    let videoInput = document.getElementById('videoInput');
                                    videoInput.click();

                                    videoInput.addEventListener('change', function() {
                                        if (videoInput.files && videoInput.files[0]) {
                                            const videoElement = document.getElementById('videoPreview');
                                            const videoSource = document.getElementById('videoSource');
                                            videoSource.src = URL.createObjectURL(videoInput.files[0]);
                                            videoElement.style.display = 'block';
                                            document.getElementById('imagePreview').style.display = 'none';
                                            document.getElementById('postBtn').disabled = false;
                                        }
                                    });
                                });

                                document.getElementById('postBtn').addEventListener('click', function() {
                                    const formData = new FormData();
                                    const content = document.getElementById('postContent').value;
                                    const image = document.getElementById('imageInput').files[0];
                                    const video = document.getElementById('videoInput').files[0];

                                    // Menambahkan data ke FormData
                                    formData.append('content', content);
                                    if (image) formData.append('image', image);
                                    if (video) formData.append('video', video);

                                    // Mengirim data menggunakan AJAX atau POST
                                    fetch('{{ route('posts.store') }}', {
                                            method: 'POST',
                                            headers: {
                                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                            },
                                            body: formData
                                        })
                                        .then(response => response.json())
                                        .then(data => {
                                            console.log('Post berhasil:', data);
                                            // Reset modal dan form setelah pengiriman sukses
                                            $('#imageVideoModal').modal('hide');
                                        })
                                        .catch(error => {
                                            console.error('Terjadi kesalahan:', error);
                                        });
                                });
                            </script>


                            <!-- Display posts -->
                            @foreach ($posts as $post)
                                <div class="card w-100 shadow-xss rounded-xxl border-0 ps-4 pt-4 pe-4 pb-3 mb-3">
                                    <div class="card-body p-0">
                                        <!-- Profile and time section -->
                                        <div class="d-flex align-items-center">
                                            <div
                                                class="custom-circle bg-info text-white rounded-circle d-flex align-items-center justify-content-center font-weight-bold">
                                                {{ strtoupper(substr($post->user->name, 0, 1)) }}
                                            </div>



                                            <!-- User Info -->
                                            <div class="ms-3">
                                                <h6 class="font-weight-semibold text-dark mb-0">
                                                    {{ $post->user->name }}
                                                </h6>
                                                <p class="text-muted small mb-0">
                                                    {{ $post->created_at->diffForHumans() }}</p>
                                            </div>
                                        </div>


                                        <!-- Display image if available -->
                                        @if ($post->image)
                                            <div class="card-body p-0 me-lg-5">
                                                <a href="{{ asset('storage/' . $post->image) }}"
                                                    data-lightbox="roadtr">
                                                    <img src="{{ asset('storage/' . $post->image) }}"
                                                        class="rounded-3 w-100" alt="Post Image">
                                                </a>
                                            </div>
                                        @endif

                                        <!-- Post content -->
                                        <div class="card-body p-0">
                                            <p class="fw-500 text-grey-500 lh-26 font-xssss w-100 mb-2">
                                                {{ $post->content }}</p>
                                        </div>

                                        <!-- Post interactions -->
                                        <div class="card-body d-flex p-0">
                                            <a href="#"
                                                class="emoji-bttn d-flex align-items-center fw-600 text-grey-900 text-dark lh-26 font-xssss me-2">
                                                <i
                                                    class="feather-thumbs-up text-white bg-primary-gradiant me-1 btn-round-xs font-xss"></i>
                                                <i
                                                    class="feather-heart text-white bg-red-gradiant me-2 btn-round-xs font-xss"></i>2.8K
                                                Like
                                            </a>
                                            <a href="{{ asset('storage/' . $post->image) }}" data-lightbox="roadtr"
                                                class="d-flex align-items-center fw-600 text-grey-900 text-dark lh-26 font-xssss">
                                                <i
                                                    class="feather-message-circle text-dark text-grey-900 btn-round-sm font-lg"></i><span
                                                    class="d-none-xss">22 Comment</span>
                                            </a>
                                            <a href="#"
                                                class="ms-auto d-flex align-items-center fw-600 text-grey-900 text-dark lh-26 font-xssss">
                                                <i
                                                    class="feather-share-2 text-grey-900 text-dark btn-round-sm font-lg"></i><span
                                                    class="d-none-xs">Share</span>
                                            </a>
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
                    </div>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <div class="app-footer border-0 shadow-lg bg-primary-gradiant">
            <a href="default.html" class="nav-content-bttn nav-center"><i class="feather-home"></i></a>
            <a href="default-video.html" class="nav-content-bttn"><i class="feather-package"></i></a>
            <a href="default-live-stream.html" class="nav-content-bttn" data-tab="chats"><i
                    class="feather-layout"></i></a>
            <a href="shop-2.html" class="nav-content-bttn"><i class="feather-layers"></i></a>
            <a href="default-settings.html" class="nav-content-bttn"><img src="images/female-profile.png"
                    alt="user" class="w30 shadow-xss"></a>
        </div>

    </div>

    <!-- Scripts -->
    <script src="{{ asset('dist2/js/plugin.js') }}"></script>
    <script src="{{ asset('dist2/js/lightbox.js') }}"></script>
    <script src="{{ asset('dist2/js/scripts.js') }}"></script>
    <script src="{{ asset('js/comment.js') }}"></script>
    <script src="{{ asset('js/bagikan.js') }}"></script>
    <script src="{{ asset('js/like.js') }}"></script>
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

</body>

</html>
