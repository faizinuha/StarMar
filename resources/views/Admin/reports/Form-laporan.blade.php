<form action="{{ route('report.store') }}" method="POST">
  @csrf
  <input type="hidden" name="type" value="{{ $type }}">
  <input type="hidden" name="id" value="{{ $id }}">

  <div class="mb-3">
      <label for="category" class="form-label">Kategori Laporan</label>
      <select name="category" id="category" class="form-select">
          <option value="Spam">Spam</option>
          <option value="Inappropriate">Konten Tidak Pantas</option>
          <option value="Harassment">Pelecehan</option>
      </select>
  </div>

  <div class="mb-3">
      <label for="description" class="form-label">Deskripsi</label>
      <textarea name="description" id="description" class="form-control" rows="4" required></textarea>
  </div>

  <button type="submit" class="btn btn-primary">Kirim Laporan</button>
</form>
