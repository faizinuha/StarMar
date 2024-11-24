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

                            <!-- Menampilkan Gambar jika ada -->
                            <div class="mb-4 relative">
                                <img src="{{ asset('storage/' . $post->image) }}" alt="Post Image">
                                <p class="text-gray-800 mb-4">{{ $post->content }}</p>
                                @foreach ($post->hashtags as $hashtag)
                                    <p>#{{ $hashtag->name }}</p>
                                @endforeach

                                <!-- Tombol Ellipsis untuk Hapus Gambar -->
                                <form action="{{ route('posts.destroy', $post->id) }}" method="POST" style="display: none;"
                                    id="delete-form-{{ $post->id }}">
                                    @csrf
                                    @method('DELETE')
                                </form>
                                <button class="absolute top-2 right-2 text-gray-600 hover:text-blue-500"
                                    onclick="confirmDelete({{ $post->id }})">
                                    <i class="fas fa-ellipsis-h"></i> <!-- Icon titik tiga -->
                                </button>
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
                                <button class="text-gray-600 hover:text-blue-500"
                                    onclick="openShareModal('{{ $post->id }}')">
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
        <div id="shareModal" class="fixed inset-0 bg-gray-800 bg-opacity-50 hidden flex justify-center items-center">
            <div class="bg-white p-6 rounded-lg shadow-lg w-1/3">
                <h2 class="text-lg font-bold mb-4">Bagikan ke Platform</h2>
                <div class="flex space-x-4">
                    <button class="text-blue-500" onclick="generateLink('instagram')">Instagram</button>
                    <button class="text-blue-500" onclick="generateLink('facebook')">Facebook</button>
                    <button class="text-blue-500" onclick="generateLink('twitter')">Twitter</button>
                    <button class="text-blue-500" onclick="generateLink('whatsapp')">WhatsApp</button>
                </div>
                <div class="mt-4">
                    <p id="shareLink" class="text-sm text-gray-600"></p>
                </div>
                <button class="mt-4 text-red-500" onclick="closeShareModal()">Tutup</button>
            </div>
        </div>

        <script>
            function confirmDelete(postId) {
                if (confirm("Apakah Anda yakin ingin menghapus gambar ini?")) {
                    document.getElementById('delete-form-' + postId).submit();
                }
            }

            function openShareModal(postId) {
                document.getElementById('shareModal').classList.remove('hidden');
                // Simpan ID post untuk digunakan saat generate link
                window.currentPostId = postId;
            }

            function closeShareModal() {
                document.getElementById('shareModal').classList.add('hidden');
            }

            function generateLink(platform) {
                const postId = window.currentPostId;
                let url = '';

                // Logika untuk mengenerate link sesuai platform
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
                document.getElementById('shareLink').textContent = `Link berbagi: ${url}`;
            }
        </script>

    </body>

    </html>
@endsection
