@extends('layouts.sidebars')

@section('side')
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buat Postingan - Media Sosial Sederhana</title>
    <!-- Link to Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">

    <div class="container mx-auto mt-8 p-4">
        <h1 class="text-center text-4xl font-semibold text-gray-800 mb-8">Buat Postingan Baru</h1>

        <!-- Form untuk Posting Baru -->
        @auth
            <form action="{{ route('posts.store') }}" method="POST" class="bg-white shadow-lg rounded-lg p-6 space-y-4" enctype="multipart/form-data">
                @csrf
                <div class="mb-4">
                    <textarea name="content" class="w-full p-3 border-2 border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Apa yang kamu pikirkan?" rows="3">{{ old('content') }}</textarea>
                </div>

                <!-- Input Video (opsional) -->
                <div class="mb-4">
                    <input type="url" name="video" class="w-full p-3 border-2 border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="URL Video (Opsional)" value="{{ old('video') }}">
                </div>

                <!-- Input Gambar (opsional) -->
                <div class="mb-4">
                    <input type="file" name="image" accept="image/*" class="w-full p-3 border-2 border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <button type="submit" class="w-full py-2 px-4 bg-blue-500 text-white font-semibold rounded-lg hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 transition">
                    Post
                </button>
            </form>
        @endauth

    </div>

</body>

</html>
@endsection
