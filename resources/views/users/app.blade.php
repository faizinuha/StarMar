<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>StarMar</title>

    <link rel="stylesheet" href="{{ asset('dist2/css/themify-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('dist2/css/feather.css') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('StarMar/StarMar.png') }}" style="border-radius: 50px;">
    <link rel="stylesheet" href="{{ asset('dist2/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('dist2/css/emoji.css') }}">
    <link rel="stylesheet" href="{{ asset('dist2/css/lightbox.css') }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
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
        @include('footer.footer')

        <!-- Main content -->
        @yield('content')

      

    </div>

    <!-- Scripts -->
    <script src="{{ asset('dist2/js/plugin.js') }}"></script>
    <script src="{{ asset('dist2/js/lightbox.js') }}"></script>
    <script src="{{ asset('dist2/js/scripts.js') }}"></script>

    <script src="{{ asset('js/comment.js') }}"></script>
    <script src="{{ asset('js/bagikan.js') }}"></script>
    <script src="{{ asset('js/like.js') }}"></script>


    <script>
        document.addEventListener('DOMContentLoaded', function() {
            if (Notification.permission === 'granted') {
                new Notification('Selamat Datang!', {
                    body: '{{ session('notification') }}',
                    icon: 'path/to/icon.png'
                });
            }
        })
        Notification.requestPermission().then(function(permission) {
            if (permission === 'granted') {
                console.log('Izin notifikasi diberikan.');
            } else {
                console.log('Izin notifikasi ditolak.');
            }
        });
    </script>

</body>

</html>
