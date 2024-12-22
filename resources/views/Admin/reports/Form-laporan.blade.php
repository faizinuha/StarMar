<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Laporan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="card shadow">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0">Formulir Laporan</h4>
            </div>
            <div class="card-body">
                @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif

                <form action="{{ route('report.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="type" value="{{ $type }}">
                    <input type="hidden" name="id" value="{{ $id }}">

                    <div class="mb-3">
                        <label for="category" class="form-label fw-bold">Kategori Laporan</label>
                        <select name="category" id="category" class="form-select">
                            <option value="Spam">Spam</option>
                            <option value="Inappropriate">Konten Tidak Pantas</option>
                            <option value="Harassment">Pelecehan</option>
                            <option value="Fake News">Berita Palsu</option>
                            <option value="Other">Lainnya</option>
                        </select>
                    </div>

                    <div class="mb-3 d-none" id="otherCategoryDiv">
                        <label for="other_category" class="form-label fw-bold">Kategori Lainnya</label>
                        <input type="text" name="other_category" id="other_category" class="form-control" placeholder="Masukkan kategori lainnya">
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label fw-bold">Deskripsi</label>
                        <textarea name="description" id="description" class="form-control" rows="4" placeholder="Berikan deskripsi laporan Anda..." required></textarea>
                    </div>

                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary">Kirim Laporan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Script untuk menampilkan input teks "Lainnya"
        const categorySelect = document.getElementById('category');
        const otherCategoryDiv = document.getElementById('otherCategoryDiv');
        const otherCategoryInput = document.getElementById('other_category');

        categorySelect.addEventListener('change', function() {
            if (this.value === 'Other') {
                otherCategoryDiv.classList.remove('d-none');
                otherCategoryInput.setAttribute('required', 'required');
            } else {
                otherCategoryDiv.classList.add('d-none');
                otherCategoryInput.removeAttribute('required');
                otherCategoryInput.value = ''; // Clear input value
            }
        });
    </script>
</body>
</html>
