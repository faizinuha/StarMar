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
                        <!-- Header Postingan -->
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
                            @if ($post->image)
                                <div class="mb-4 relative">
                                    <img src="{{ asset('storage/' . $post->image) }}" alt="Post Image" loading="lazy"
                                        class="mb-4">
                                    @if (Auth::id() === $post->user_id)
                                        <a href="{{ route('posts.edit', $post->id) }}"
                                            class="absolute top-0 right-0 p-2 bg-white rounded-full shadow-md hover:bg-gray-200">
                                            <i class="fas fa-edit text-xl text-gray-600"></i>
                                        </a>
                                        <form action="{{ route('posts.destroy', $post->id) }}" method="POST"
                                            class="absolute top-0 right-10 p-2 bg-white rounded-full shadow-md hover:bg-gray-200">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-xl text-red-600">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            @endif

                            <!-- Konten dengan fitur Read More -->
                            <div class="relative">
                                <p class="text-gray-800">
                                    <span class="short-content">
                                        {{ Str::limit($post->content, 100, '') }}
                                    </span>
                                    <span class="long-content hidden">
                                        {{ $post->content }}
                                    </span>
                                </p>
                                @if (strlen($post->content) > 100)
                                    <button class="read-more text-blue-500 text-sm mt-2">Read More</button>
                                @endif
                            </div>

                            <!-- Hashtag -->
                            <div class="mt-2">
                                @foreach ($post->hashtags as $hashtag)
                                    <span class="text-sm text-blue-500">#{{ $hashtag->name }}</span>
                                @endforeach
                            </div>
                        </div>

                        <!-- Footer Postingan -->
                        <div class="flex items-center justify-between p-4 border-t">
                            <div class="flex items-center space-x-6">
                                @php
                                    $isLiked = $post->likedByUsers->contains(auth()->id());
                                @endphp

                                <button class="like-button {{ $isLiked ? 'liked' : '' }}"
                                    data-post-id="{{ $post->id }}">
                                    <i class="fas fa-heart"></i>
                                </button>
                                <span class="like-count">{{ $post->likedByUsers->count() }}</span>

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

                        <!-- Komentar -->
                        <div class="p-4 border-t">
                            <div class="comments space-y-4">
                                @foreach ($post->comments as $comment)
                                    <div class="comment" id="comment-{{ $comment->id }}">
                                        <div class="flex space-x-4">
                                            <div
                                                class="w-8 h-8 bg-blue-200 rounded-full flex items-center justify-center text-white font-semibold">
                                                {{ strtoupper(substr($comment->user->name, 0, 1)) }}
                                            </div>
                                            <div>
                                                <h5 class="font-semibold text-gray-800">{{ $comment->user->name }}</h5>
                                                <p class="text-sm text-gray-500">
                                                    {{ $comment->created_at->diffForHumans() }}</p>
                                                <p class="text-gray-800">{{ $comment->content }}</p>
                                            </div>
                                        </div>

                                        <!-- Balasan -->
                                        <div class="replies ml-10 space-y-4">
                                            @foreach ($comment->replies as $reply)
                                                <div class="flex space-x-4">
                                                    <div
                                                        class="w-8 h-8 bg-green-200 rounded-full flex items-center justify-center text-white font-semibold">
                                                        {{ strtoupper(substr($reply->user->name, 0, 1)) }}
                                                    </div>
                                                    <div>
                                                        <h5 class="font-semibold text-gray-800">{{ $reply->user->name }}
                                                        </h5>
                                                        <p class="text-sm text-gray-500">
                                                            {{ $reply->created_at->diffForHumans() }}</p>
                                                        <p class="text-gray-800">{{ $reply->content }}</p>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>

                                        <!-- Tombol & Form Balasan -->
                                        <button class="reply-btn text-sm text-blue-500 mt-2"
                                            data-comment-id="{{ $comment->id }}">
                                            Reply
                                        </button>
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
                                <textarea name="content" class="w-full border rounded-lg p-2 text-gray-800" placeholder="Add a comment..."></textarea>
                                <button type="submit"
                                    class="bg-blue-500 text-white px-4 py-2 mt-2 rounded-lg">Comment</button>
                            </form>
                        </div>


                    </div>
                @endforeach
            </div>



            {{-- Modal --}}
            <div id="shareModal-{{ $post->id }}"
                class="fixed inset-0 bg-gray-800 bg-opacity-50 hidden flex justify-center items-center">
                <div class="bg-white p-6 rounded-lg shadow-lg w-1/3">
                    <h2 class="text-lg font-bold mb-4">Bagikan ke Platform</h2>
                    <div class="flex space-x-4">
                        <button class="text-blue-500"
                            onclick="generateLink('instagram', {{ $post->id }})">Instagram</button>
                        <button class="text-blue-500"
                            onclick="generateLink('facebook', {{ $post->id }})">Facebook</button>
                        <button class="text-blue-500"
                            onclick="generateLink('twitter', {{ $post->id }})">Twitter</button>
                        <button class="text-blue-500"
                            onclick="generateLink('whatsapp', {{ $post->id }})">WhatsApp</button>
                    </div>
                    <div class="mt-4">
                        <p id="shareLink-{{ $post->id }}" class="text-sm text-gray-600"></p>
                    </div>
                    <button class="mt-4 text-red-500" onclick="closeShareModal({{ $post->id }})">Tutup</button>
                </div>
            </div>
        </div>

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


    </body>

    </html>
@endsection
