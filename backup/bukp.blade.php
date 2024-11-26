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
            <h1 class="text-3xl font-bold text-center text-blue-600 mb-6">StarMar</h1>

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
                            <!-- Menampilkan Gambar jika ada -->
                            @if ($post->image)
                                <div class="mb-4 relative">
                                    <img src="{{ asset('storage/' . $post->image) }}" alt="Post Image" class="mb-4">
                                </div>
                            @endif

                            <!-- Konten dengan fitur Read More -->
                            <div class="relative">
                                <p class="text-gray-800">
                                    <span class="short-content">
                                        {{ Str::limit($post->content, 100, '') }}
                                        <!-- Menampilkan hanya 100 karakter pertama -->
                                    </span>
                                    <span class="long-content hidden">
                                        {{ $post->content }} <!-- Menampilkan semua konten -->
                                    </span>
                                </p>
                                @if (strlen($post->content) > 100)
                                    <button class="read-more text-blue-500 text-sm mt-2">Read More</button>
                                @endif
                            </div>

                            <!-- Menampilkan hashtag -->
                            <div class="mt-2">
                                @foreach ($post->hashtags as $hashtag)
                                    <span class="text-sm text-blue-500">#{{ $hashtag->name }}</span>
                                @endforeach
                            </div>
                        </div>

                        <!-- Footer Postingan (Tombol Like, Comment, Share) -->
                        <div class="flex items-center justify-between p-4 border-t">
                            <div class="flex items-center space-x-6">
                                <!-- Like Button (Icon) -->
                                @php
                                    $isLiked = $post->likedByUsers->contains(auth()->id());
                                @endphp

                                <button class="like-button {{ $isLiked ? 'liked' : '' }}"
                                    data-post-id="{{ $post->id }}">
                                    <i class="fas fa-heart"></i>
                                </button>
                                <span class="like-count">{{ $post->likedByUsers->count() }}</span>
                                <!-- Comment Button (Icon) -->
                                <button class="text-gray-600 hover:text-blue-500">
                                    <i class="fas fa-comment"></i> Comment
                                </button>
                                <button class="text-gray-600 hover:text-blue-500"
                                    onclick="openShareModal({{ $post->id }})">
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

        <!-- Modal Share -->
        <div id="shareModal-{{ $post->id }}"
            class="fixed inset-0 bg-gray-800 bg-opacity-50 hidden flex justify-center items-center">
            <div class="bg-white p-6 rounded-lg shadow-lg w-1/3">
                <h2 class="text-lg font-bold mb-4">Bagikan ke Platform</h2>
                <div class="flex space-x-4">
                    <button class="text-blue-500"
                        onclick="generateLink('instagram', {{ $post->id }})">Instagram</button>
                    <button class="text-blue-500" onclick="generateLink('facebook', {{ $post->id }})">Facebook</button>
                    <button class="text-blue-500" onclick="generateLink('twitter', {{ $post->id }})">Twitter</button>
                    <button class="text-blue-500" onclick="generateLink('whatsapp', {{ $post->id }})">WhatsApp</button>
                </div>
                <div class="mt-4">
                    <p id="shareLink-{{ $post->id }}" class="text-sm text-gray-600"></p>
                </div>
                <button class="mt-4 text-red-500" onclick="closeShareModal({{ $post->id }})">Tutup</button>
            </div>
        </div>
        <!-- CSS -->
        <style>
            .hidden {
                display: none;
            }

            .read-more {
                cursor: pointer;
            }

            .like-button.liked i {
                color: red;
            }

            .like-button {
                display: inline-flex;
                align-items: center;
                margin-right: 1px;
            }

            .like-count {
                font-size: 14px;
                color: #888;
                margin-left: 1px;
                vertical-align: middle;
            }
        </style>

        {{-- like --}}
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const likeButtons = document.querySelectorAll('.like-button');

                likeButtons.forEach(button => {
                    button.addEventListener('click', function() {
                        const postId = this.dataset.postId;
                        const likeCountElement = this
                            .nextElementSibling; // Ambil elemen setelah tombol (jumlah like)

                        fetch('/like', {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': document.querySelector(
                                        'meta[name="csrf-token"]').getAttribute('content')
                                },
                                body: JSON.stringify({
                                    post_id: postId
                                })
                            })
                            .then(response => response.json())
                            .then(data => {
                                if (data.status === 'liked') {
                                    this.classList.add('liked');
                                } else if (data.status === 'unliked') {
                                    this.classList.remove('liked');
                                }
                                // Update jumlah like
                                likeCountElement.textContent = data.like_count;
                            })
                            .catch(error => console.error('Error:', error));
                    });
                });
            });
        </script>


        <script>
            document.addEventListener('DOMContentLoaded', () => {
                const readMoreButtons = document.querySelectorAll('.read-more');

                readMoreButtons.forEach(button => {
                    button.addEventListener('click', (event) => {
                        const parent = event.target.parentElement;
                        const shortContent = parent.querySelector('.short-content');
                        const longContent = parent.querySelector('.long-content');

                        // Tampilkan konten penuh
                        shortContent.classList.toggle('hidden');
                        longContent.classList.toggle('hidden');

                        // Ubah teks tombol
                        if (longContent.classList.contains('hidden')) {
                            button.textContent = 'Read More';
                        } else {
                            button.textContent = 'Read Less';
                        }
                    });
                });
            });

            function confirmDelete(postId) {
                if (confirm("Apakah Anda yakin ingin menghapus gambar ini?")) {
                    document.getElementById('delete-form-' + postId).submit();
                }
            }

            function openShareModal(postId) {
                // Tampilkan modal yang sesuai dengan ID postingan
                document.getElementById(`shareModal-${postId}`).classList.remove('hidden');
            }

            function closeShareModal(postId) {
                // Sembunyikan modal yang sesuai dengan ID postingan
                document.getElementById(`shareModal-${postId}`).classList.add('hidden');
            }

            function generateLink(platform, postId) {
                let url = '';

                // Logika untuk membangkitkan tautan sesuai platform
                switch (platform) {
                    case 'instagram':
                        url = `https://www.instagram.com/?url={{ url('posts') }}/${postId}`;
                        break;
                    case 'facebook':
                        url = `https://www.facebook.com/sharer/sharer.php?u={{ url('posts') }}/${postId}`;
                        break;
                    case 'twitter':
                        url = `https://twitter.com/intent/tweet?url={{ url('posts') }}/${postId}`;
                        break;
                    case 'whatsapp':
                        url = `https://wa.me/?text={{ url('posts') }}/${postId}`;
                        break;
                    default:
                        url = `https://www.example.com/${postId}`;
                }

                // Tampilkan URL di dalam modal
                const shareLinkElement = document.getElementById(`shareLink-${postId}`);
                shareLinkElement.textContent = `Link berbagi: ${url}`;

            }
        </script>

    </body>

    </html>
@endsection
