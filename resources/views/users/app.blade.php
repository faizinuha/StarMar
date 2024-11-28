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
                                            Create Post
                                        </p>
                                        <textarea name="content"
                                            class="h100 bor-0 w-100 rounded-xxl p-2 ps-5 font-xssss text-grey-500 fw-500 border-light-md theme-dark-bg"
                                            cols="30" rows="10" placeholder="What's on your mind?">{{ old('content') }}</textarea>
                                        <input type="file" name="image" class="mt-3" />
                                        <button type="submit" class="btn btn-primary mt-3">Post</button>
                                    </form>
                                </div>
                            </div>

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
                                                <h6 class="font-weight-semibold text-dark mb-0">{{ $post->user->name }}
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
            <a href="default-settings.html" class="nav-content-bttn"><img src="images/female-profile.png" alt="user"
                    class="w30 shadow-xss"></a>
        </div>

    </div>

    <!-- Scripts -->
    <script src="{{ asset('dist2/js/plugin.js') }}"></script>
    <script src="{{ asset('dist2/js/lightbox.js') }}"></script>
    <script src="{{ asset('dist2/js/scripts.js') }}"></script>
    <script src="{{ asset('js/comment.js') }}"></script>
    <script src="{{ asset('js/bagikan.js') }}"></script>
    <script src="{{ asset('js/like.js') }}"></script>

</body>

</html>
