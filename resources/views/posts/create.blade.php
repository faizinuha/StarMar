
<div class="container mx-auto mt-2 p-2">
    <div class="flex">
        <!-- Sidebar -->
        <div class="w-1/4 p-4">
            @include('posts.sidebars')
        </div>
        <!-- Main Content -->
        <div class="w-3/4 p-4">
            <h1 class="text-center text-4xl font-semibold text-gray-800 mb-4">Buat Postingan Baru</h1>
            @auth
                <form action="{{ route('posts.store') }}" method="POST" class="bg-white shadow-lg rounded-lg p-6 space-y-4 flex flex-col lg:flex-row" enctype="multipart/form-data">
                    @csrf

                    <!-- Bagian Kiri -->
                    <div class="w-full lg:w-1/2 p-4 border-r border-gray-300 space-y-4">
                        <!-- Input Gambar -->
                        <div>
                            <label for="image">Unggah Gambar</label>
                            <input type="file" id="image" name="image" accept="image/*"
                                class="w-full p-3 border-2 border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                                onchange="previewImage(event)">
                        </div>

                        <!-- Preview Gambar -->
                        <div id="imagePreviewContainer" class="relative" style="display: none;">
                            <h3 class="text-lg font-semibold mb-2">Preview Gambar</h3>

                            <!-- Tombol Crop & Filter -->
                            <div class="absolute top-2 right-2 flex space-x-2 z-50">
                                <button type="button" id="toggleCrop"
                                    class="p-2 bg-blue-500 text-white font-semibold rounded-full hover:bg-blue-600">
                                    Crop
                                </button>
                                <button type="button" id="toggleFilter"
                                    class="p-2 bg-green-500 text-white font-semibold rounded-full hover:bg-green-600">
                                    Filter
                                </button>
                            </div>

                            <!-- Daftar Filter -->
                            <div id="filterOptions"
                                class="absolute top-12 right-2 bg-white shadow-lg p-4 rounded-lg space-y-2 hidden z-50">
                                <button type="button" class="filter-btn bg-gray-200 px-4 py-2 rounded-lg"
                                    data-filter="none">None</button>
                                <button type="button" class="filter-btn bg-gray-200 px-4 py-2 rounded-lg"
                                    data-filter="grayscale(1)">Grayscale</button>
                                <button type="button" class="filter-btn bg-gray-200 px-4 py-2 rounded-lg"
                                    data-filter="sepia(1)">Sepia</button>
                                <button type="button" class="filter-btn bg-gray-200 px-4 py-2 rounded-lg"
                                    data-filter="contrast(2)">High Contrast</button>
                            </div>

                            <!-- Area Gambar -->
                            <img id="imagePreview" class="rounded-lg max-w-full shadow-lg" alt="Preview Gambar">

                            <!-- Tombol Simpan -->
                            <div class="mt-4">
                                <button type="button" id="applyChanges"
                                    class="px-4 py-2 bg-purple-500 text-white font-semibold rounded-lg hover:bg-purple-600 focus:outline-none">
                                    Simpan Perubahan
                                </button>
                            </div>
                        </div>

                        <input type="hidden" name="filter" id="selectedFilter">
                        <input type="hidden" id="croppedImageData" name="cropped_image">
                    </div>

                    <!-- Bagian Kanan -->
                    <div class="w-full lg:w-1/2 p-4 space-y-4">
                        <!-- Input Konten -->
                        <div>
                            <textarea name="content"
                                class="w-full p-3 border-2 border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                                placeholder="Apa yang kamu pikirkan?" rows="3">{{ old('content') }}</textarea>
                        </div>

                        <!-- Input Upload Video -->
                        <div>
                            <label for="video">Unggah Video</label>
                            <input type="file" name="video" accept="video/*"
                                class="w-full p-3 border-2 border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>

                        <!-- Input Hashtag -->
                        <div>
                            <label for="hashtags">Hashtag:</label>
                            <input type="text" id="hashtags" name="hashtags" placeholder="Tambahkan hashtag"
                                autocomplete="off" class="w-full p-3 border-2 border-gray-300 rounded-lg">
                            <div id="hashtagSuggestions"
                                class="border border-gray-300 rounded-lg shadow-lg p-2 mt-2 hidden max-h-40 overflow-y-auto">
                            </div>
                        </div>

                        <!-- Tombol Kirim -->
                        <button type="submit"
                            class="w-full py-2 px-4 bg-blue-500 text-white font-semibold rounded-lg hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 transition">
                            Post
                        </button>
                    </div>
                </form>
            @endauth
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    let cropper;
    let filterMode = false; // Menandakan jika filter mode aktif

    // Preview Gambar
    function previewImage(event) {
        const file = event.target.files[0];
        const previewContainer = document.getElementById('imagePreviewContainer');
        const previewImage = document.getElementById('imagePreview');

        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                previewImage.src = e.target.result;
                previewContainer.style.display = 'block';
            };
            reader.readAsDataURL(file);
        }
    }

    // Toggle Crop Mode
    document.getElementById('toggleCrop').addEventListener('click', (event) => {
        event.preventDefault(); // Mencegah relog saat tombol ditekan
        const image = document.getElementById('imagePreview');

        if (filterMode) {
            // Jika filter mode aktif, matikan filter terlebih dahulu
            const filterButtons = document.querySelectorAll('.filter-btn');
            filterButtons.forEach(button => button.classList.remove('bg-green-600', 'hover:bg-green-700'));
            image.style.filter = ''; // Reset filter
            document.getElementById('selectedFilter').value = 'none';
            filterMode = false; // Nonaktifkan mode filter
        }

        if (!cropper) {
            cropper = new Cropper(image, {
                aspectRatio: 1,
                viewMode: 2,
            });
            alert('Mode crop diaktifkan!');
        } else {
            cropper.destroy();
            cropper = null;
            alert('Mode crop dinonaktifkan!');
        }
    });

    // Toggle Filter Mode
    document.getElementById('toggleFilter').addEventListener('click', (event) => {
        event.preventDefault(); // Mencegah relog saat tombol ditekan
        const filterOptions = document.getElementById('filterOptions');
        filterOptions.classList.toggle('hidden'); // Tampilkan atau sembunyikan daftar filter

        // Tambahkan event listener ke setiap tombol filter
        document.querySelectorAll('.filter-btn').forEach((btn) => {
            btn.addEventListener('click', function() {
                const selectedFilter = this.getAttribute('data-filter');
                const image = document.getElementById('imagePreview');
                image.style.filter = selectedFilter;
                document.getElementById('selectedFilter').value = selectedFilter;
            });
        });
    });

    // Apply Changes (Save Filter/Crop)
    document.getElementById('applyChanges').addEventListener('click', (event) => {
        event.preventDefault(); // Mencegah relog saat tombol ditekan
        const image = document.getElementById('imagePreview');
        const croppedImageInput = document.getElementById('croppedImageData');

        if (cropper) {
            const canvas = cropper.getCroppedCanvas();
            croppedImageInput.value = canvas.toDataURL('image/jpeg'); // Simpan base64 hasil crop
            alert('Hasil crop berhasil disimpan!');
            cropper.destroy();
            cropper = null;
        } else {
            alert('Hasil filter disimpan!');
        }
    });


    // Apply Changes (Save Filter/Crop)
    document.getElementById('applyChanges').addEventListener('click', () => {
        const image = document.getElementById('imagePreview');

        if (cropper) {
            const canvas = cropper.getCroppedCanvas();
            document.getElementById('croppedImageData').value = canvas.toDataURL('image/jpeg');
            alert('Hasil crop berhasil disimpan!');

            // Setelah perubahan disimpan, nonaktifkan mode crop dan filter
            cropper.destroy();
            cropper = null;
            filterMode = false;
            document.getElementById('selectedFilter').value = 'none';
            image.style.filter = ''; // Reset filter
        } else {
            alert('Simpan filter berhasil!');

            // Jika hanya filter yang disimpan, matikan mode filter
            filterMode = false;
            cropper = false;
            image.style.filter = ''; // Reset filter
            document.getElementById('selectedFilter').value = 'none';
        }
    });
</script>
