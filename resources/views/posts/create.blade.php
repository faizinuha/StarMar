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

                    <!-- Input Gambar -->
                    <div class="mb-4">
                        <label for="image">Unggah Gambar</label>
                        <input type="file" id="image" name="image" accept="image/*"
                            class="w-full p-3 border-2 border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                            onchange="previewImage(event)">
                    </div>

                    <!-- Preview Gambar -->
                    <div id="imagePreviewContainer" class="mb-4" style="display: none;">
                        <h3 class="text-lg font-semibold mb-2">Preview Gambar</h3>
                        <img id="imagePreview" class="rounded-lg max-w-full shadow-lg" alt="Preview Gambar">
                        <div class="mt-4">
                            <h4 class="font-semibold">Pilih Filter:</h4>
                            <div class="flex space-x-2">
                                <button type="button" class="filter-btn px-3 py-2 bg-gray-300 rounded-lg"
                                    data-filter="none">Tanpa Filter</button>
                                <button type="button" class="filter-btn px-3 py-2 bg-gray-300 rounded-lg"
                                    data-filter="grayscale(100%)">Grayscale</button>
                                <button type="button" class="filter-btn px-3 py-2 bg-gray-300 rounded-lg"
                                    data-filter="sepia(100%)">Sepia</button>
                                <button type="button" class="filter-btn px-3 py-2 bg-gray-300 rounded-lg"
                                    data-filter="blur(2px)">Blur</button>
                            </div>
                        </div>
                        <!-- Hidden Input untuk Filter -->
                        <input type="hidden" name="filter" id="selectedFilter">
                    </div>
                    <!-- Preview Gambar -->
                    <div id="imagePreviewContainer" class="mb-4" style="display: none;">
                        <h3 class="text-lg font-semibold mb-2">Crop Gambar</h3>
                        <div class="w-full max-w-sm mx-auto">
                            <img id="imageToCrop" class="rounded-lg max-w-full shadow-lg" alt="Gambar untuk Crop">
                        </div>
                        <div class="mt-4">
                            <button type="button" id="cropImageButton"
                                class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600">
                                Crop & Save
                            </button>
                        </div>
                    </div>

                    <!-- Input Video -->
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

                    <!-- Video Short -->
                    <div class="mb-4">
                        <label for="video_short">Unggah Video Pendek</label>
                        <input type="file" name="video_short" accept="video/mp4" class="form-control">
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
        let cropper;

        function previewImage(event) {
            const previewContainer = document.getElementById('imagePreviewContainer');
            const imageToCrop = document.getElementById('imageToCrop');
            const file = event.target.files[0];

            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    imageToCrop.src = e.target.result;
                    previewContainer.style.display = 'block';

                    // Inisialisasi Cropper.js
                    if (cropper) {
                        cropper.destroy(); // Hancurkan instance sebelumnya
                    }
                    cropper = new Cropper(imageToCrop, {
                        aspectRatio: 1, // Ratio 1:1 (bisa disesuaikan)
                        viewMode: 2,
                    });
                };
                reader.readAsDataURL(file);
            }
        }

        document.getElementById('cropImageButton').addEventListener('click', function() {
            if (cropper) {
                const canvas = cropper.getCroppedCanvas({
                    width: 500, // Dimensi hasil crop
                    height: 500,
                });

                // Kirim hasil crop ke server sebagai Base64
                canvas.toBlob(function(blob) {
                    const formData = new FormData();
                    formData.append('croppedImage', blob);

                    // Kirim ke server menggunakan Fetch API
                    fetch('{{ route('posts.store') }}', {
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            },
                            body: formData
                        })
                        .then(response => response.json())
                        .then(data => {
                            alert('Gambar berhasil diunggah!');
                            window.location.href = '{{ route('beranda') }}';
                        })
                        .catch(error => {
                            console.error('Error:', error);
                        });
                });
            }
        });
    </script>

    <script>
        // Preview Image Function
        function previewImage(event) {
            const previewContainer = document.getElementById('imagePreviewContainer');
            const previewImage = document.getElementById('imagePreview');
            const file = event.target.files[0];

            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    previewImage.src = e.target.result;
                    previewContainer.style.display = 'block';
                };
                reader.readAsDataURL(file);
            }
        }

        // Filter Selection
        document.querySelectorAll('.filter-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                const selectedFilter = this.getAttribute('data-filter');
                document.getElementById('imagePreview').style.filter = selectedFilter;
                document.getElementById('selectedFilter').value = selectedFilter;
            });
        });

        // Hashtag Suggestion
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
