<link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">

<div class="container mx-auto my-10">
  <div class="max-w-4xl mx-auto bg-white shadow-xl rounded-lg overflow-hidden">
    <div class="bg-gradient-to-r from-blue-500 to-blue-700 text-white text-center py-6">
      <h2 class="text-3xl font-semibold">Penanganan Laporan</h2>
    </div>

    <div class="p-8">
      <!-- Informasi Laporan -->
      <div class="mb-6 space-y-4">
        <p><strong class="text-lg">Pelapor:</strong> <span class="text-gray-600">{{ $report->reporter->first_name }}</span></p>
        <p><strong class="text-lg">Nama Postingan:</strong> <span class="text-gray-600">{{ $report->reportedPost->content }}</span></p>
        <p><strong class="text-lg">Kategori:</strong> <span class="text-gray-600">{{ $report->category }}</span></p>
        <p><strong class="text-lg">Deskripsi:</strong> <span class="text-gray-600">{{ $report->description }}</span></p>

        <!-- Gambar Postingan -->
        <div class="w-full max-w-md mx-auto">
          <img src="{{ asset('storage/' . $report->reportedPost->image) }}" class="rounded-xl shadow-lg w-full" alt="Gambar Postingan">
        </div>
      </div>

      <!-- Form untuk Tindakan -->
      <form action="{{ route('admin.reports.action', $report->id) }}" method="POST">
        @csrf
        <div class="mb-6">
          <label for="action" class="block text-gray-700 font-medium mb-2">Tindakan</label>
          <select name="action" id="action" class="block w-full px-4 py-3 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500" required>
            <option value="" disabled selected>Pilih Tindakan</option>
            <option value="delete_post">Hapus Postingan</option>
            <option value="block_user">Blokir User</option>
            <option value="ignore">Abaikan</option>
          </select>
        </div>

        <div class="mb-6">
          <label for="reason" class="block text-gray-700 font-medium mb-2">Alasan</label>
          <textarea name="reason" id="reason" rows="5" class="block w-full px-4 py-3 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500" placeholder="Alasan tindakan (jika diperlukan)" required></textarea>
        </div>

        <div class="flex justify-end">
          <button type="submit" class="px-6 py-3 bg-blue-600 text-white font-semibold rounded-lg shadow-md hover:bg-blue-700 focus:outline-none focus:ring-4 focus:ring-blue-300">
            Simpan
          </button>
        </div>
        <div class="flex justify-end">
          <a href="{{route('admin.reports')}}" type="submit" class="px-6 py-3 bg-blue-600 text-white font-semibold rounded-lg shadow-md hover:bg-blue-700 focus:outline-none focus:ring-4 focus:ring-blue-300">
            Kembali
          </a>
        </div>
      </form>
    </div>
  </div>
</div>
