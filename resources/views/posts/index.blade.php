@extends('layouts.sidebars')

@section('side')
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Media Sosial Sederhana</title>
        <script src="https://cdn.tailwindcss.com"></script>
    </head>

    <body class="bg-gray-100 text-gray-800">

        <div class="container mx-auto max-w-3xl py-8">
            <h1 class="text-3xl font-bold text-center text-blue-600 mb-6">Media Sosial Sederhana</h1>

            <!-- Daftar Postingan -->
            <div class="space-y-8">
                @foreach ($posts as $post)
                    <div class="bg-white shadow-md rounded-lg overflow-hidden">
                        <!-- Header Postingan (Nama Pengguna & Tanggal) -->
                        <div class="flex items-center space-x-4 p-4 border-b">
                            <div
                                class="w-10 h-10 bg-blue-200 rounded-full flex items-center justify-center text-white font-semibold">
                                {{ strtoupper(substr($post->user->name, 0, 1)) }}
                            </div>
                            <div>
                                <h5 class="font-semibold text-lg text-gray-800">{{ $post->user->name }}</h5>
                                <p class="text-sm text-gray-500">{{ $post->created_at->diffForHumans() }}</p>
                            </div>
                        </div>

                        <!-- Konten Postingan -->
                        <div class="p-4">
                            <p class="text-gray-800 mb-4">{{ $post->content }}</p>
                            <!-- Menampilkan Gambar jika ada -->                    
                                <div class="mb-4">
                                    <img src="{{ asset('storage/' . $post->image) }}" alt="Post Image"
                                        class="w-full h-auto rounded-lg shadow-md">
                                </div>
                            <!-- Menampilkan Video jika ada -->
                            @if ($post->video)
                                <div class="mb-4">
                                    <video width="100%" controls class="rounded-lg shadow-md">
                                        <source src="{{ $post->video }}" type="video/mp4">
                                        Your browser does not support the video tag.
                                    </video>
                                </div>
                            @endif
                        </div>

                        <!-- Footer Postingan (Tombol Like, Comment, Share) -->
                        <div class="flex items-center justify-between p-4 border-t">
                            <div class="flex items-center space-x-6">
                                <!-- Like Button (Icon) -->
                                <button class="text-gray-600 hover:text-blue-500">
                                    <i class="fas fa-heart"></i> Like
                                </button>
                                <!-- Comment Button (Icon) -->
                                <button class="text-gray-600 hover:text-blue-500">
                                    <i class="fas fa-comment"></i> Comment
                                </button>
                                <!-- Share Button (Icon) -->
                                <button class="text-gray-600 hover:text-blue-500">
                                    <i class="fas fa-share-alt"></i> Share
                                </button>
                            </div>
                            <div>
                                <button class="text-gray-600 hover:text-blue-500">
                                    <i class="fas fa-bookmark"></i> Save
                                </button>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

    </body>

    </html>
@endsection
