<!DOCTYPE html>
<html>
<head>
    <title>Peringatan Login</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 text-gray-800">
    <div class="max-w-lg mx-auto mt-10 p-6 bg-white rounded-lg shadow-lg">
        <h1 class="text-2xl font-bold mb-4">Peringatan Login</h1>
        <p class="mb-4">Halo, <span class="font-semibold">{{ $user->name }}</span>!</p>
        <p class="mb-4">Akun Anda baru saja login dari perangkat atau browser yang berbeda:</p>
        <ul class="mb-4">
            <li><strong>Browser:</strong> {{ $browser }}</li>
            <li><strong>Perangkat:</strong> {{ $device }}</li>
            <li><strong>Sistem Operasi:</strong> {{ $platform }}</li>
            <li><strong>Alamat IP:</strong> {{ $ip }}</li>
        </ul>
        <p class="mb-4">Jika ini memang Anda, masukkan kode berikut:</p>
        <h2 class="text-3xl font-bold text-center bg-gray-200 p-4 rounded-lg mb-4">{{ $verificationCode }}</h2>
        <p class="text-red-500">Jika bukan Anda, segera ubah kata sandi Anda.</p>
    </div>
</body>
</html>
