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
                <h2 class="text-2xl font-bold">StartMar</h2>
            </div>
            <nav class="mt-8">
                <ul class="space-y-4 px-6">
                    <li>
                        <a href="{{ route('beranda') }}"
                            class="flex items-center space-x-3 py-2 px-4 rounded-lg hover:bg-blue-700">
                            <i class="fas fa-home text-lg"></i>
                            <span>Home</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{route('dashboard')}}" class="flex items-center space-x-3 py-2 px-4 rounded-lg hover:bg-blue-700">
                            <i class="fas fa-search text-lg"></i>
                            <span>Explore</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('posts.create') }}"
                            class="flex items-center space-x-3 py-2 px-4 rounded-lg hover:bg-blue-700">
                            <i class="fas fa-upload text-lg"></i>
                            <span>Uploads</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('profile.edit') }}"
                            class="flex items-center space-x-3 py-2 px-4 rounded-lg hover:bg-blue-700">
                            <i class="fas fa-bell text-lg"></i>
                            <span>Notifications</span>
                        </a>
                    </li>

                    <li class="relative group">
                        <button class="flex items-center space-x-3 py-2 px-4 w-full rounded-lg hover:bg-blue-700">
                            <div
                                class="w-8 h-8 bg-gray-300 rounded-full flex items-center justify-center text-white font-semibold">
                                {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                            </div>
                            <span>{{ auth()->user()->name }}</span>
                            <i class="fas fa-caret-down ml-2"></i>
                        </button>

                        <!-- Dropdown Menu -->
                        <div class="absolute left-0 mt-2 w-full bg-white shadow-lg rounded-lg hidden group-hover:block transition-all duration-300 transform scale-95 opacity-0 group-hover:scale-100 group-hover:opacity-100">
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
<style>
    .hidden {
    display: none;
}
.group-hover\:block {
    display: block;
}
.transition-all {
    transition: all 0.3s ease-in-out;
}

</style>
<script>
    document.addEventListener('DOMContentLoaded', () => {
    const dropdownButton = document.querySelector('.dropdown-button');
    const dropdownMenu = document.querySelector('.dropdown-menu');

    dropdownButton.addEventListener('click', () => {
        dropdownMenu.classList.toggle('hidden');
    });
});

</script>
        <!-- Main Content -->
        @yield('side')
    </div>

</body>

</html>
