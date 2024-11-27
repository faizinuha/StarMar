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
                        <textarea id="content" name="content" rows="5" class="form-control @error('content') is-invalid @enderror"
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
                            <img src="{{ asset('storage/' . $post->image) }}" alt="Post Image" class="img-thumbnail mt-3"
                                style="width: 150px; height: 150px; object-fit: cover;">
                        @endif
                        @error('image')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label for="filter" class="form-label fw-bold">Filter</label>
                        <select name="filter" id="filter" class="form-control">
                            <option value="">Tanpa Filter</option>
                            <option value="grayscale" {{ $post->filter === 'grayscale' ? 'selected' : '' }}>Grayscale
                            </option>
                            <option value="sepia" {{ $post->filter === 'sepia' ? 'selected' : '' }}>Sepia</option>
                            <option value="blur" {{ $post->filter === 'blur' ? 'selected' : '' }}>Blur</option>
                        </select>
                    </div>

                    <div class="mb-4">
                        <label for="crop" class="form-label fw-bold">Crop</label>
                        <select name="crop" id="crop" class="form-control">
                            <option value="">Tanpa Crop</option>
                            <option value="1:1" {{ $post->crop === '1:1' ? 'selected' : '' }}>1:1</option>
                            <option value="16:9" {{ $post->crop === '16:9' ? 'selected' : '' }}>16:9</option>
                            <option value="4:3" {{ $post->crop === '4:3' ? 'selected' : '' }}>4:3</option>
                        </select>
                    </div>

                    <div class="mb-4">
                        <label for="video_short" class="form-label fw-bold">Video Pendek</label>
                        <input type="file" id="video_short" name="video_short" class="form-control">
                        @if ($post->video_short)
                            <video width="150" controls class="rounded shadow-sm mt-3">
                                <source src="{{ asset('storage/' . $post->video_short) }}" type="video/mp4">
                            </video>
                        @endif
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
