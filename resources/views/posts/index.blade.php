@extends('layouts.app')

@section('content')
    <div class="container py-5">
        <div class="card shadow-lg border-0">
            <div class="card-header bg-gradient-primary text-white text-center">
                <h4 class="mb-0">Data Postingan</h4>
            </div>
            <div class="card-body">
                @if ($posts->isEmpty())
                    <p class="text-center text-muted fs-5">Tidak ada data postingan.</p>
                @else
                    <table class="table table-hover table-bordered align-middle">
                        <thead class="table-dark">
                            <tr>
                                <th>#</th>
                                <th>Nama</th>
                                <th>Gambar</th>
                                <th>Konten</th>
                                <th>Video</th>
                                <th>Tanggal</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($posts as $post)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $post->user->name }}</td>
                                    <td>
                                        <img src="{{ asset('storage/' . $post->image) }}" alt="Gambar Postingan"
                                            class="img-thumbnail rounded-circle"
                                            style="width: 80px; height: 80px; object-fit: cover;">
                                    </td>
                                    <td>{{ $post->filter ?: 'Tidak ada' }}</td>
                                    <td>{{ $post->crop ?: 'Tidak ada' }}</td>
                                    <td>
                                        <div class="text-truncate" style="max-width: 200px;">
                                            {{ $post->content }}
                                        </div>
                                    </td>
                                    <td>
                                        @if (!empty($post->video))
                                            <video width="100" controls class="rounded shadow-sm">
                                                <source src="{{ $post->video }}" type="video/mp4">
                                            </video>
                                        @else
                                            <span class="text-muted">Tidak ada video</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if (!empty($post->video_short))
                                            <video width="100" controls class="rounded shadow-sm">
                                                <source src="{{ asset('storage/' . $post->video_short) }}" type="video/mp4">
                                            </video>
                                        @else
                                            <span class="text-muted">Tidak ada video pendek</span>
                                        @endif
                                    </td>
                                    <td>{{ $post->created_at->format('d-m-Y') }}</td>
                                    <td>
                                        <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-sm btn-primary">
                                            <i class="bi bi-pencil-square"></i> Edit
                                        </a>
                                        <form action="{{ route('posts.destroy', $post->id) }}" method="POST"
                                            class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger"
                                                onclick="return confirm('Apakah Anda yakin ingin menghapus postingan ini?')">
                                                <i class="bi bi-trash"></i> Hapus
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
        </div>
    </div>

    <style>
        /* Gradien untuk header */
        .bg-gradient-primary {
            background: linear-gradient(45deg, #007bff, #6c63ff);
        }

        /* Hover efek untuk tabel */
        .table-hover tbody tr:hover {
            background-color: #f1f3f5;
        }

        /* Thumbnail gambar */
        .img-thumbnail {
            border: 2px solid #dee2e6;
            padding: 4px;
        }

        /* Button style */
        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }

        .btn-danger {
            background-color: #dc3545;
            border-color: #dc3545;
        }

        .btn-primary:hover,
        .btn-danger:hover {
            opacity: 0.9;
        }

        /* Untuk teks konten yang panjang */
        .text-truncate {
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }
    </style>
@endsection
