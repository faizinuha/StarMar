<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Media Sosial Sederhana</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100 text-gray-800">

    <!-- Wrapper -->
    <div class="flex min-h-screen">

        <!-- Sidebar -->
        <aside class="w-64 bg-blue-600 text-white flex-shrink-0">
            <div class="p-6 flex items-center justify-center space-x-3">
                <i class="fab fa-instagram text-3xl"></i>
                <h2 class="text-2xl font-bold">Media Sosial</h2>
            </div>
            <nav class="mt-8">
                <ul class="space-y-4 px-6">
                    <li>
                        <a href="{{ route('posts.index') }}" class="flex items-center space-x-3 py-2 px-4 rounded-lg hover:bg-blue-700">
                            <i class="fas fa-home text-lg"></i>
                            <span>Home</span>
                        </a>
                    </li>
                    <li>
                        <a href="#" class="flex items-center space-x-3 py-2 px-4 rounded-lg hover:bg-blue-700">
                            <i class="fas fa-search text-lg"></i>
                            <span>Explore</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('posts.create') }}" class="flex items-center space-x-3 py-2 px-4 rounded-lg hover:bg-blue-700">
                            <i class="fas fa-upload text-lg"></i>
                            <span>Uploads</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('profile.edit') }}" class="flex items-center space-x-3 py-2 px-4 rounded-lg hover:bg-blue-700">
                            <i class="fas fa-bell text-lg"></i>
                            <span>Notifications</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('profile.edit') }}" class="flex items-center space-x-3 py-2 px-4 rounded-lg hover:bg-blue-700">
                            <i class="fas fa-user text-lg"></i>
                            <span>Profile</span>
                        </a>
                    </li>

                    @auth
                    <li>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="flex items-center space-x-3 py-2 px-4 w-full text-left rounded-lg hover:bg-blue-700">
                                <i class="fas fa-sign-out-alt text-lg"></i>
                                <span>Logout</span>
                            </button>
                        </form>
                    </li>
                    @endauth
                </ul>
            </nav>
        </aside>

        <!-- Main Content -->
        @yield('side')
    </div>

</body>

</html>
