@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="card shadow-lg border-0">
        <div class="card-header bg-gradient-primary text-white text-center">
            <h4 class="mb-0">Edit Post</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('posts.update', $post->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label for="content" class="form-label fw-bold">Konten</label>
                    <textarea id="content" name="content" rows="5" 
                        class="form-control @error('content') is-invalid @enderror"
                        required>{{ old('content', $post->content) }}</textarea>
                    @error('content')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="image" class="form-label fw-bold">Gambar</label>
                    <input type="file" id="image" name="image" 
                        class="form-control @error('image') is-invalid @enderror">
                    @if ($post->image)
                        <img src="{{ asset('storage/' . $post->image) }}" alt="Post Image" 
                             class="img-thumbnail mt-3" style="width: 150px; height: 150px; object-fit: cover;">
                    @endif
                    @error('image')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-save"></i> Update
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
    .bg-gradient-primary {
        background: linear-gradient(45deg, #007bff, #6c63ff);
        color: white;
    }

    .form-control:focus {
        border-color: #007bff;
        box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
    }

    .btn-primary {
        background-color: #007bff;
        border-color: #007bff;
    }

    .btn-primary:hover {
        opacity: 0.9;
    }

    .invalid-feedback {
        font-size: 0.875rem;
        color: #dc3545;
    }
</style>
@endsection
