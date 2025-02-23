@extends('users.app')
@section('content')
    <div class="main-content right-chat-active">
        <div class="middle-sidebar-bottom">
            <div class="middle-sidebar-left pe-0">
                <div class="row">
                    <div class="col-xl-12">
                        <!-- Search Bar -->
                        <div class="card shadow-xss w-100 d-block d-flex border-0 p-4 mb-3">
                            <div class="card-body d-flex align-items-center p-0">
                                <h2 class="fw-700 mb-0 mt-0 font-md text-grey-900">Explorer</h2>
                                <div class="search-form-2 ms-auto">
                                    <form action="{{ route('explorer.search') }}" method="GET">
                                        <i class="ti-search font-xss"></i>
                                        <input type="text" name="q" value="{{ request('q') }}"
                                            class="form-control text-grey-500 mb-0 bg-greylight theme-dark-bg border-0"
                                            placeholder="Search here.">
                                    </form>
                                </div>
                            </div>
                        </div>

                        <!-- Display All Users -->
                        <div class="card shadow-xss w-100 d-block d-flex border-0 p-4 mb-3">
                            <h4 class="fw-700 mb-3 mt-0 font-md text-grey-900">Users</h4>
                            <div class="d-flex flex-wrap gap-3">
                                @foreach ($users as $user)
                                    <div class="d-flex align-items-center gap-3">
                                        <img src="{{ asset('storage/' . $user->photo_profile) }}"
                                            alt="{{ $user->first_name }}" class="rounded-circle"
                                            style="width: 50px; height: 50px; object-fit: cover;" onclick="window.location.href='{{ route('profile', $user->id) }}'">
                                        <div>
                                            <p class="mb-0 fw-600 text-grey-900"><a href="{{route('profile', $user->id)}}">{{ $user->first_name }}</a>
                                                {{-- {{ $user->last_name }}</p> --}}
                                            <small class="text-grey-500">{{ $user->bio }}</small>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <!-- Display Posts -->
                        <div class="grid grid-cols-3 gap-4 md:grid-cols-4 lg:grid-cols-6">
                            @foreach ($posts as $post)
                                <div class="relative cursor-pointer" data-bs-toggle="modal"
                                    data-bs-target="#postModal-{{ $post->id }}">
                                    @if ($post->image)
                                        <img src="{{ asset('storage/' . $post->image) }}" alt="Post Image"
                                            class="w-full h-full object-cover rounded-lg">
                                    @elseif($post->video)
                                        <video class="w-full h-full object-cover rounded-lg" muted autoplay loop>
                                            <source src="{{ asset('storage/' . $post->video) }}" type="video/mp4">
                                            Your browser does not support the video tag.
                                        </video>
                                    @endif
                                </div>

                                <!-- Modal -->
                                <div class="modal fade mx-l" id="postModal-{{ $post->id }}" tabindex="-1"
                                    aria-labelledby="postModalLabel-{{ $post->id }}" aria-hidden="true"
                                    data-bs-backdrop="false" wire:ignore>
                                    <div class="modal-dialog modal-lg modal-dialog-scrollable">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="postModalLabel-{{ $post->id }}">Post by
                                                    User {{ $post->user_id }}</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                @if ($post->image)
                                                    <img src="{{ asset('storage/' . $post->image) }}" alt="Post Image"
                                                        class="w-full rounded-lg">
                                                @elseif($post->video)
                                                    <video controls class="w-full rounded-lg">
                                                        <source src="{{ asset('storage/' . $post->video) }}"
                                                            type="video/mp4">
                                                        Your browser does not support the video tag.
                                                    </video>
                                                @endif
                                                <p class="mt-3">{{ $post->content }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
