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

                <div class="p-4 border-t">
                    <!-- List Komentar -->
                    <div class="comments space-y-4">
                        @foreach ($post->comments as $comment)
                            <div class="comment" id="comment-{{ $comment->id }}">
                                <div class="flex space-x-4">
                                    <!-- Profil pengguna komentar -->
                                    <div
                                        class="w-8 h-8 bg-blue-200 rounded-full flex items-center justify-center text-white font-semibold">
                                        {{ strtoupper(substr($comment->user->name, 0, 1)) }}
                                    </div>
                                    <div>
                                        <h5 class="font-semibold text-gray-800">{{ $comment->user->name }}</h5>
                                        <p class="text-sm text-gray-500">{{ $comment->created_at->diffForHumans() }}</p>
                                        <p class="text-gray-800">{{ $comment->content }}</p>
                                    </div>
                                </div>

                                <!-- Tampilkan Balasan -->
                                <div class="replies ml-10 space-y-4">
                                    @foreach ($comment->replies as $reply)
                                        <div class="flex space-x-4">
                                            <div
                                                class="w-8 h-8 bg-green-200 rounded-full flex items-center justify-center text-white font-semibold">
                                                {{ strtoupper(substr($reply->user->name, 0, 1)) }}
                                            </div>
                                            <div>
                                                <h5 class="font-semibold text-gray-800">{{ $reply->user->name }}</h5>
                                                <p class="text-sm text-gray-500">{{ $reply->created_at->diffForHumans() }}
                                                </p>
                                                <p class="text-gray-800">{{ $reply->content }}</p>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>

                                <!-- Tombol balasan -->
                                <button class="reply-btn text-sm text-blue-500 mt-2" data-comment-id="{{ $comment->id }}">
                                    Reply
                                </button>

                                <!-- Form Balasan (akan muncul setelah klik tombol Reply) -->
                                <form class="reply-form hidden mt-4" data-comment-id="{{ $comment->id }}">
                                    @csrf
                                    <input type="hidden" name="post_id" value="{{ $post->id }}">
                                    <input type="hidden" name="parent_id" value="{{ $comment->id }}">
                                    <textarea name="content" class="w-full border rounded-lg p-2 text-gray-800" placeholder="Add a reply..."></textarea>
                                    <button type="submit"
                                        class="bg-green-500 text-white px-4 py-2 mt-2 rounded-lg">Reply</button>
                                </form>
                            </div>
                        @endforeach
                    </div>

                    <!-- Form Komentar Baru -->
                    <form class="comment-form mt-4" data-post-id="{{ $post->id }}">
                        @csrf
                        <input type="hidden" name="post_id" value="{{ $post->id }}">
                        <input type="hidden" name="parent_id" value="">
                        <!-- Nilai parent_id kosong untuk komentar utama -->
                        <textarea name="content" class="w-full border rounded-lg p-2 text-gray-800" placeholder="Add a comment..."></textarea>
                        <button type="submit" class="bg-blue-500 text-white px-4 py-2 mt-2 rounded-lg">Comment</button>
                    </form>
                </div>

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

        {{-- KOMENTAR --}}
        <script>
            $(document).ready(function() {
                // Menampilkan form balasan saat tombol Reply diklik
                $('.reply-btn').click(function() {
                    const commentId = $(this).data('comment-id');
                    const form = $(this).closest('.comment').find('.reply-form');
                    form.toggleClass('hidden');
                    form.find('textarea').focus();
                    form.find('input[name="parent_id"]').val(commentId); // Menyimpan ID komentar induk
                });

                // Mengirim komentar utama dengan AJAX
                $('.comment-form').submit(function(e) {
                    e.preventDefault(); // Mencegah reload halaman

                    const form = $(this);
                    const postId = form.data('post-id'); // Ambil post_id dari data-post-id
                    const content = form.find('textarea[name="content"]').val(); // Ambil konten komentar
                    const token = form.find('input[name="_token"]').val(); // Ambil CSRF token

                    if (!content) {
                        alert('Content is required!');
                        return;
                    }

                    $.ajax({
                        url: '/comments',
                        type: 'POST',
                        data: {
                            _token: token,
                            post_id: postId,
                            content: content,
                            parent_id: '', // parent_id kosong untuk komentar utama
                        },
                        success: function(response) {
                            form.find('textarea[name="content"]').val(
                                ''); // Kosongkan textarea setelah submit

                            let newCommentHTML = `
                    <div class="comment" id="comment-${response.id}">
                        <div class="flex space-x-4">
                            <div class="w-8 h-8 bg-blue-200 rounded-full flex items-center justify-center text-white font-semibold">
                                ${response.user.charAt(0).toUpperCase()}
                            </div>
                            <div>
                                <h5 class="font-semibold text-gray-800">${response.user}</h5>
                                <p class="text-sm text-gray-500">${response.created_at}</p>
                                <p class="text-gray-800">${response.content}</p>
                                <button class="reply-btn bg-gray-200 text-gray-800 px-4 py-2 mt-2 rounded-lg" data-comment-id="${response.id}">Reply</button>
                                <div class="replies"></div>
                            </div>
                        </div>
                    </div>
                `;
                            $('.comments-list').prepend(
                                newCommentHTML); // Menambahkan komentar baru di bagian atas
                        },
                        error: function(error) {
                            alert('Error: ' + error.responseJSON.message);
                        },
                    });
                });

                // Mengirim balasan dengan AJAX
                $('.reply-form').submit(function(e) {
                    e.preventDefault(); // Mencegah reload halaman

                    const form = $(this);
                    const postId = form.find('input[name="post_id"]').val(); // Ambil post_id
                    const parentId = form.find('input[name="parent_id"]').val(); // Ambil parent_id
                    const content = form.find('textarea[name="content"]').val(); // Ambil konten balasan
                    const token = form.find('input[name="_token"]').val(); // Ambil CSRF token

                    if (!content) {
                        alert('Content is required!');
                        return;
                    }

                    $.ajax({
                        url: '/comments',
                        type: 'POST',
                        data: {
                            _token: token,
                            post_id: postId,
                            parent_id: parentId,
                            content: content,
                        },
                        success: function(response) {
                            form.find('textarea[name="content"]').val(
                                ''); // Kosongkan textarea setelah submit
                            form.addClass('hidden'); // Sembunyikan form balasan

                            let newReplyHTML = `
                    <div class="flex space-x-4">
                        <div class="w-8 h-8 bg-green-200 rounded-full flex items-center justify-center text-white font-semibold">
                            ${response.user.charAt(0).toUpperCase()}
                        </div>
                        <div>
                            <h5 class="font-semibold text-gray-800">${response.user}</h5>
                            <p class="text-sm text-gray-500">${response.created_at}</p>
                            <p class="text-gray-800">${response.content}</p>
                        </div>
                    </div>
                `;
                            $(`#comment-${parentId} .replies`).prepend(
                                newReplyHTML); // Tambahkan balasan ke komentar induk
                        },
                        error: function(error) {
                            alert('Error: ' + error.responseJSON.message);
                        },
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
