@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0 text-center" >Data Postingan</h4>
        </div>
        <div class="card-body">
            @if($posts->isEmpty())
                <p class="text-center text-muted">Tidak ada data postingan.</p>
            @else
                <table class="table table-hover table-bordered">
                    <thead class="table-dark">
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Gambar</th>
                            <th>Konten</th>
                            <th>Video</th>
                            <th>Tanggal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($posts as $post)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>  {{ $post->user->name }}</td>
                            <td>
                                <img src="{{ asset('storage/' . $post->image) }}" 
                                     alt="Gambar Postingan" 
                                     class="img-thumbnail" 
                                     style="width: 100px; height: 100px; object-fit: cover;">
                            </td>
                            <td>{{ $post->content }}</td>
                            <td>
                                @if (!empty($post->video)) <!-- Memeriksa apakah properti `video` tidak kosong -->
                                    <div class="mb-4">
                                        <video width="100%" controls class="rounded-lg shadow-md">
                                            <source src="{{ asset('storage/' . $post->video) }}" type="video/mp4">
                                            Your browser does not support the video tag.
                                        </video>
                                    </div>
                                @else
                                    <span class="text-muted">Tidak ada video</span>
                                @endif
                            </td>                            
                            <td>{{ $post->created_at->format('d-m-Y') }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>
</div>
<style>
    .table-hover tbody tr:hover {
    background-color: #f8f9fa; /* Warna abu muda saat hover */
}

.table th, .table td {
    vertical-align: middle; /* Agar teks dan gambar sejajar tengah */
}

.card-header {
    background: linear-gradient(45deg, #1e88e5, #42a5f5); /* Gradien biru */
    color: white;
}

</style>
@endsection
