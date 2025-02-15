<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gemini X Mahiro AI</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }

        .sidebar {
            width: 250px;
            height: 100vh;
            border-right: 1px solid #e5e7eb;
        }

        .sidebar-item {
            padding: 0.75rem 1rem;
            margin: 0.25rem 0;
            border-radius: 0.5rem;
            transition: background-color 0.2s;
        }

        .sidebar-item:hover {
            background-color: #f3f4f6;
        }

        .account {
            position: absolute;
            top: 80%;
            border-radius: 0.5rem;
            background-color: #f3f4f6;
        }
    </style>
</head>

<body class="flex">
    <!-- Sidebar -->
    <div class="sidebar bg-white p-4">
        <!-- New Chat -->
        <h3 class="text-sm font-semibold text-gray-500">Actions</h3>

        <div class="sidebar-item cursor-pointer bg-blue-500 text-white" onclick="newChat()">
            <span>New Chat</span>
        </div>

        <!-- History Chat -->
        <div class="mt-4">
            <h3 class="text-sm font-semibold text-gray-500 mb-2">History Chat</h3>
            <div id="historyChat" class="space-y-1">
                <!-- Daftar riwayat chat akan dimuat di sini -->
                <div class="sidebar-item cursor-pointer">Percakapan 1</div>
                <div class="sidebar-item cursor-pointer">Percakapan 2</div>
                <div class="sidebar-item cursor-pointer">Percakapan 3</div>
            </div>
        </div>

        <!-- Account -->
        @php
            // Cek apakah pengguna sudah login
            $auth = Auth::user();
            $photoPath = Auth::check() ? Auth::user()->photo_profile : null; // Path foto profil jika user login
            $photoExists = $photoPath && file_exists(public_path('storage/' . $photoPath)); // Cek file
        @endphp
        <div class="mt-auto account ">
            <div class="sidebar-item cursor-pointer" onclick="toggleDropdown()">
                @if ($photoExists)
                    <img src="{{ asset('storage/' . $photoPath) }}" alt="Profile Photo"
                        class="w-8 h-8 rounded-full inline-block">
                @else
                    <img src="{{ asset('users/avatar.png') }}" alt="Default Profile Photo"
                        class="p-1 bg-white rounded-xl w-100">
                @endif
                <span  >{{ Auth::user()->first_name }}</span>
            </div>

            <!-- Dropdown Menu -->
            <div id="accountDropdown"
                class="hidden absolute bottom-full mb-2 w-full bg-white border border-gray-200 rounded-lg shadow-lg">
                @if ($auth)
                    <!-- Jika pengguna sudah login -->
                  
                        <div class="p-2 hover:bg-gray-100 cursor-pointer"onclick="openAccount()">
                            Profile
                        </div>
                    <div class="p-2 hover:bg-gray-100 cursor-pointer" onclick="logout()">
                        Logout
                    </div>
                @else
                    <!-- Jika pengguna belum login -->
                    <a href="{{ route('login') }}" class="block p-2 hover:bg-gray-100 cursor-pointer">
                        Login
                    </a>
                    <a href="{{ route('register') }}" class="block p-2 hover:bg-gray-100 cursor-pointer">
                        Register
                    </a>
                @endif
            </div>
        </div>

        <script>
            // Fungsi untuk menampilkan/sembunyikan dropdown
            function toggleDropdown() {
                const dropdown = document.getElementById('accountDropdown');
                dropdown.classList.toggle('hidden');
            }

            // Fungsi untuk logout
            function logout() {
                fetch("{{ route('logout') }}", {
                        method: "POST",
                        headers: {
                            "Content-Type": "application/json",
                            "X-CSRF-TOKEN": "{{ csrf_token() }}"
                        }
                    })
                    .then(response => {
                        if (response.redirected) {
                            window.location.href = response.url; // Redirect ke halaman login
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                    });
            }

            // Tutup dropdown saat klik di luar dropdown
            document.addEventListener('click', function(event) {
                const dropdown = document.getElementById('accountDropdown');
                const accountButton = document.querySelector('.account .sidebar-item');
                if (!dropdown.contains(event.target) && !accountButton.contains(event.target)) {
                    dropdown.classList.add('hidden');
                }
            });
        </script>
    </div>

    <!-- Main Content -->
    <div class="flex-1">
        @yield('content')
    </div>

    <script>
        // Fungsi untuk New Chat
        function newChat() {
            alert("Memulai percakapan baru...");
            window.location.href = '{{ route('ai-gemini.index') }}';
            // Tambahkan logika untuk memulai percakapan baru di sini
        }
        @php
    $user = Auth::check() ? Auth::user() : null;
    $profileRoute = $user ? route('user.profile', $user->id) : '#';
    @endphp
        // Fungsi untuk membuka halaman atau modal Account
        function openAccount() {
            alert("Membuka halaman account...");
            window.location.href = '{{ $profileRoute }}';
            // Tambahkan logika untuk membuka halaman atau modal account di sini
        }
    </script>
  
</body>

</html>
