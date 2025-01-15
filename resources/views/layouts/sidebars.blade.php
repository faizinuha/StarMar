<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Media Sosial Sederhana</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Cropper.js CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.13/cropper.min.css">
    <!-- Cropper.js JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.13/cropper.min.js"></script>
    <script src="{{ asset('js/comment.js') }}"></script>
    <script src="{{ asset('js/bagikan.js') }}"></script>
    <script src="{{ asset('js/like.js') }}"></script>

</head>

<body class="bg-gray-100 text-gray-800">

    <!-- Wrapper -->
    <div class="flex min-h-screen">

        <!-- Sidebar -->
        <aside class="w-64 bg-gray-600 text-white flex-shrink-0">
            <div class="p-6 flex items-center justify-center space-x-3">
                <i class="fab fa-instagram text-3xl"></i>
                <h2 class="text-2xl font-bold">StartMar</h2>
            </div>
            <nav class="mt-8">
                <ul class="space-y-4 px-6">
                    @if (Auth::check() && Auth::user()->hasRole('admin'))
                        <li>
                            <a href="{{ route('dashboard') }} "
                                class="flex items-center space-x-3 py-2 px-4 rounded-lg hover:bg-blue-700">
                                <i class="fas fa-home text-lg"></i>
                                <span>Dashboard</span>
                            </a>
                        </li>
                    @else
                        <li>
                            <a href="{{ route('beranda') }} "
                                class="flex items-center space-x-3 py-2 px-4 rounded-lg hover:bg-blue-700">
                                <i class="fas fa-home text-lg"></i>
                                <span>Home</span>
                            </a>
                        </li>
                    @endif
                    <li>
                        <a href="#" class="flex items-center space-x-3 py-2 px-4 rounded-lg hover:bg-blue-700">
                            <i class="fas fa-search text-lg"></i>
                            <span>Explore</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('posts.create') }} "
                            class="flex items-center space-x-3 py-2 px-4 rounded-lg hover:bg-blue-700">
                            <i class="fas fa-upload text-lg"></i>
                            <span>Uploads</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('profile.edit') }} "
                            class="flex items-center space-x-3 py-2 px-4 rounded-lg hover:bg-blue-700">
                            <i class="fas fa-bell text-lg"></i>
                            <span>Notifications</span>
                        </a>
                    </li>
                    <li class="nav-item">
    <a href="{{ route('admin.maintenance') }}" class="nav-link">
        <i class="bi bi-wrench"></i> Maintenance Management
    </a>
</li>


                    <!-- Profile Dropdown -->
                    <li class="relative">
                        <button id="dropdown-button"
                            class="flex items-center space-x-3 py-2 px-4 w-full rounded-lg hover:bg-blue-700">
                            <div
                                class="w-8 h-8 bg-gray-300 rounded-full flex items-center justify-center text-white font-semibold">
                                {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                            </div>
                            <span>{{ auth()->user()->name }}</span>
                            <i class="fas fa-caret-down ml-2"></i>
                        </button>

                        <!-- Dropdown Menu -->
                        <div id="dropdown-menu"
                            class="absolute left-0 mt-2 w-full bg-white shadow-lg rounded-lg hidden">
                            <ul class="space-y-2">
                                <li>
                                    <a href="{{ route('profile.edit') }}"
                                        class="block py-2 px-4 text-gray-800 hover:bg-gray-200 rounded-lg">
                                        <i class="fas fa-user-circle mr-2"></i> Profile
                                    </a>
                                </li>
                                <li>
                                    <a href="#"
                                        class="block py-2 px-4 text-gray-800 hover:bg-gray-200 rounded-lg">
                                        <i class="fas fa-cogs mr-2"></i> Settings
                                    </a>
                                </li>
                                <li>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit"
                                            class="w-full text-left py-2 px-4 text-gray-800 hover:bg-gray-200 rounded-lg">
                                            <i class="fas fa-sign-out-alt mr-2"></i> Logout
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    </li>
                </ul>
            </nav>
        </aside>

        <!-- Main Content -->
        <div class="flex-1 bg-slate-700 bg-gray-100">
            @yield('side')
        </div>
    </div>

    <style>
        .hidden {
            display: none;
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const dropdownButton = document.getElementById('dropdown-button');
            const dropdownMenu = document.getElementById('dropdown-menu');

            // Toggle the dropdown menu when the button is clicked
            dropdownButton.addEventListener('click', function() {
                dropdownMenu.classList.toggle('hidden');
            });

            // Close the dropdown menu if clicked outside of it
            document.addEventListener('click', function(e) {
                if (!dropdownButton.contains(e.target) && !dropdownMenu.contains(e.target)) {
                    dropdownMenu.classList.add('hidden');
                }
            });
        });
    </script>

</body>

</html>
