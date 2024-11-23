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
                <form action="{{ route('posts.store') }}" method="POST" class="bg-white shadow-lg rounded-lg p-6 space-y-4"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="mb-4">
                        <textarea name="content"
                            class="w-full p-3 border-2 border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                            placeholder="Apa yang kamu pikirkan?" rows="3">{{ old('content') }}</textarea>
                    </div>
                    <!-- Input Gambar (opsional) -->
                    <div class="mb-4">
                        <input type="file" name="image" accept="image/*"
                            class="w-full p-3 border-2 border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>

                    <!-- Input Video (opsional) -->
                    <div class="mb-4">
                        <input type="url" name="video"
                            class="w-full p-3 border-2 border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                            placeholder="URL Video (Opsional)" value="{{ old('video') }}">
                    </div>

                    <div>
                        <label for="hashtags">Hashtag:</label>
                        <input type="text" id="hashtags" name="hashtags" placeholder="Tambahkan hashtag" autocomplete="off">
                        <div id="hashtagSuggestions"
                            style="display: none; border: 1px solid #ddd; max-height: 150px; overflow-y: auto;">
                            <!-- Daftar suggestion hashtag muncul di sini -->
                        </div>
                    </div>
                    <button type="submit"
                        class="w-full py-2 px-4 bg-blue-500 text-white font-semibold rounded-lg hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 transition">
                        Post
                    </button>
                </form>
            @endauth

        </div>

    </body>

    <script>
        const input = document.getElementById('hashtags');
        const suggestions = document.getElementById('hashtagSuggestions');

        input.addEventListener('input', function() {
            const query = this.value;

            if (query.length > 1) {
                fetch(`/hashtags/suggest?query=${query}`)
                    .then(response => response.json())
                    .then(data => {
                        suggestions.innerHTML = '';
                        data.forEach(hashtag => {
                            const div = document.createElement('div');
                            div.textContent = hashtag.name;
                            div.style.cursor = 'pointer';
                            div.addEventListener('click', function() {
                                input.value = hashtag.name;
                                suggestions.style.display = 'none';
                            });
                            suggestions.appendChild(div);
                        });
                        suggestions.style.display = 'block';
                    });
            } else {
                suggestions.style.display = 'none';
            }
        });
    </script>

    </html>
@endsection
