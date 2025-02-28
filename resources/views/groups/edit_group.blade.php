<div class="container mx-auto p-4">
  <h1 class="text-2xl font-bold mb-4">Edit Grup</h1>
  <form action="{{ route('groups.update', $group->id) }}" method="POST">
      @csrf
      @method('PUT')
      <div class="mb-4">
          <label class="block text-gray-700">Nama Grup</label>
          <input type="text" name="name" value="{{ $group->name }}" class="w-full p-2 border rounded">
      </div>
      <div class="mb-4">
          <label class="block text-gray-700">Deskripsi</label>
          <textarea name="description" class="w-full p-2 border rounded">{{ $group->description }}</textarea>
      </div>
      <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded">Simpan Perubahan</button>
  </form>
</div>