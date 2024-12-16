<div class="gallery">
  @foreach ($pos as $p)
      <div class="gallery-item">
          <!-- Menampilkan gambar -->
          @if ($p->image)
              <img src="{{ asset('storage/' . $p->image) }}" alt="Image" class="gallery-image" />
          @endif

          <!-- Menampilkan video -->
          @if ($p->video)
              <video controls class="gallery-video">
                  <source src="{{ asset('storage/' . $p->video) }}" type="video/mp4">
                  Your browser does not support the video tag.
              </video>
          @endif

          <!-- Menampilkan konten -->
          <div class="gallery-item-info">
              <p><strong>Content:</strong> {{ $p->content }}</p>

              <!-- Jika ada filter dan crop -->
              @if ($p->filter)
                  <p><strong>Filter:</strong> {{ $p->filter }}</p>
              @endif
              @if ($p->crop)
                  <p><strong>Crop:</strong> {{ $p->crop }}</p>
              @endif
          </div>
      </div>
  @endforeach
</div>
