<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>StarMar</title>

    <link rel="stylesheet" href="{{ asset('dist2/css/themify-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('dist2/css/feather.css') }}">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('dist2/images/favicon.png') }}">
    <!-- Custom Stylesheet -->
    <link rel="stylesheet" href="{{ asset('dist2/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('dist2/css/emoji.css') }}">

    <link rel="stylesheet" href="{{ asset('dist2/css/lightbox.css') }}">

</head>

<body class="color-theme-blue mont-font">

    <div class="preloader"></div>


    <div class="main-wrapper">

        <!-- navigation top-->
        @include('users.components.navbar')
        <!-- navigation top -->

        <!-- navigation left -->
        @include('users.components.navleft')
        <!-- navigation left -->

        <!-- main content -->
        <div class="main-content right-chat-active">

            <div class="middle-sidebar-bottom">
                <div class="middle-sidebar-left">
                    <div class="row feed-body">
                        <div class="col-xl-8 col-xxl-9 col-lg-8">

                            <div class="card w-100 shadow-xss rounded-xxl border-0 ps-4 pt-4 pe-4 pb-3 mb-3">
                                <div class="card-body p-0">
                                    <a href="#"
                                        class=" font-xssss fw-600 text-grey-500 card-body p-0 d-flex align-items-center"><i
                                            class="btn-round-sm font-xs text-primary feather-edit-3 me-2 bg-greylight"></i>Create
                                        Post</a>
                                </div>
                                <div class="card-body p-0 mt-3 position-relative">
                                    <figure class="avatar position-absolute ms-2 mt-1 top-5"><img
                                            src="images/user-8.png" alt="image" class="shadow-sm rounded-circle w30">
                                    </figure>
                                    <textarea name="message"
                                        class="h100 bor-0 w-100 rounded-xxl p-2 ps-5 font-xssss text-grey-500 fw-500 border-light-md theme-dark-bg"
                                        cols="30" rows="10" placeholder="What's on your mind?"></textarea>
                                </div>
                            </div>
                            <div class="card w-100 shadow-xss rounded-xxl border-0 p-4 mb-0">
                                <div class="card-body p-0 d-flex">
                                    <figure class="avatar me-3"><img src="images/user-8.png" alt="image"
                                            class="shadow-sm rounded-circle w45"></figure>
                                    <h4 class="fw-700 text-grey-900 font-xssss mt-1">Anthony Daugloi <span
                                            class="d-block font-xssss fw-500 mt-1 lh-3 text-grey-500">2 hour
                                            ago</span></h4>
                                    <a href="#" class="ms-auto"><i
                                            class="ti-more-alt text-grey-900 btn-round-md bg-greylight font-xss"></i></a>
                                </div>
                                <div class="card-body p-0 me-lg-5">
                                    <p class="fw-500 text-grey-500 lh-26 font-xssss w-100 mb-2">Lorem ipsum dolor sit
                                        amet, consectetur adipiscing elit. Morbi nulla dolor, ornare at commodo non,
                                        feugiat non nisi. Phasellus faucibus mollis pharetra. Proin blandit ac massa sed
                                        rhoncus <a href="#" class="fw-600 text-primary ms-2">See more</a></p>
                                </div>
                                <div class="card-body d-block p-0 mb-3">
                                    <div class="row ps-2 pe-2">
                                        <div class="col-sm-12 p-1"><a href="images/t-30.jpg" data-lightbox="roadtr"><img
                                                    src="images/t-31.jpg" class="rounded-3 w-100" alt="image"></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body d-flex p-0">
                                    <a href="#"
                                        class="emoji-bttn d-flex align-items-center fw-600 text-grey-900 text-dark lh-26 font-xssss me-2"><i
                                            class="feather-thumbs-up text-white bg-primary-gradiant me-1 btn-round-xs font-xss"></i>
                                        <i
                                            class="feather-heart text-white bg-red-gradiant me-2 btn-round-xs font-xss"></i>2.8K
                                        Like</a>
                                    <div class="emoji-wrap">
                                        <ul class="emojis list-inline mb-0">
                                            <li class="emoji list-inline-item"><i class="em em---1"></i> </li>
                                            <li class="emoji list-inline-item"><i class="em em-angry"></i></li>
                                            <li class="emoji list-inline-item"><i class="em em-anguished"></i> </li>
                                        </ul>
                                    </div>
                                    <a href="#"
                                        class="d-flex align-items-center fw-600 text-grey-900 text-dark lh-26 font-xssss"><i
                                            class="feather-message-circle text-dark text-grey-900 btn-round-sm font-lg"></i><span
                                            class="d-none-xss">22 Comment</span></a>
                                    <a href="#"
                                        class="ms-auto d-flex align-items-center fw-600 text-grey-900 text-dark lh-26 font-xssss"><i
                                            class="feather-share-2 text-grey-900 text-dark btn-round-sm font-lg"></i><span
                                            class="d-none-xs">Share</span></a>
                                </div>
                            </div>
                            @yield('content')
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
        <!-- main content -->

        <div class="app-footer border-0 shadow-lg bg-primary-gradiant">
            <a href="default.html" class="nav-content-bttn nav-center"><i class="feather-home"></i></a>
            <a href="default-video.html" class="nav-content-bttn"><i class="feather-package"></i></a>
            <a href="default-live-stream.html" class="nav-content-bttn" data-tab="chats"><i
                    class="feather-layout"></i></a>
            <a href="shop-2.html" class="nav-content-bttn"><i class="feather-layers"></i></a>
            <a href="default-settings.html" class="nav-content-bttn"><img src="images/female-profile.png"
                    alt="user" class="w30 shadow-xss"></a>
        </div>

        <div class="app-header-search">
            <form class="search-form">
                <div class="form-group searchbox mb-0 border-0 p-1">
                    <input type="text" class="form-control border-0" placeholder="Search...">
                    <i class="input-icon">
                        <ion-icon name="search-outline" role="img" class="md hydrated"
                            aria-label="search outline"></ion-icon>
                    </i>
                    <a href="#" class="ms-1 mt-1 d-inline-block close searchbox-close">
                        <i class="ti-close font-xs"></i>
                    </a>
                </div>
            </form>
        </div>
    </div>
    <script src="{{ asset('dist2/js/plugin.js') }}"></script>

    <script src="{{ asset('dist2/js/lightbox.js') }}"></script>
    <script src="{{ asset('dist2/js/scripts.js') }}"></script>


</body>

</html>
