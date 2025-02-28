<!-- resources/views/groups/show.blade.php -->
@extends('users.app')

@section('content')
    <div class="main-content right-chat-active">
        <div class="middle-sidebar-bottom">
            <div class="middle-sidebar-left">
                <div class="row">
                    <!-- Sidebar Kiri -->
                    @php
                    $photoPath = $group->owner->photo_profile; // Ambil foto dari pemilik grup
                    $photoExists = $photoPath && file_exists(public_path('storage/' . $photoPath)); 
                @endphp
                    <div class="col-xl-4 col-xxl-3 col-lg-4 pe-0">
                        <div class="card w-100 shadow-xss rounded-xxl overflow-hidden border-0 mb-3 mt-3 pb-3">
                            <div class="card-body position-relative h150 bg-image-cover bg-image-center"
                                style="background-image: url({{ asset('images/group-bg.jpg') }});"></div>
                            <div class="card-body d-block pt-4 text-center">
                                @if ($photoExists)
                                <figure class="avatar mt--6 position-relative w75 z-index-1 w100 ms-auto me-auto">
                                    <img src="{{ asset('storage/' . $photoPath) }}" alt="image"
                                        class="p-1 bg-white rounded-xl w-100">
                                </figure>
                                @else
                                    <figure class="avatar mt--6 position-relative w75 z-index-1 w100 ms-auto me-auto">
                                        <img src="{{ asset('users/avatar.png') }}" alt="image"
                                            class="p-1 bg-white rounded-xl w-100">
                                    </figure>
                                @endif
                                <h4 class="font-xs ls-1 fw-700 text-grey-900">{{ $group->name }}
                                    <span
                                        class="d-block font-xssss fw-500 mt-1 lh-3 text-grey-500">{{ '@' . Str::slug($group->name) }}</span>
                                </h4>
                            </div>

                            <!-- Tombol Join/Leave Grup -->
                            <div class="card-body d-flex align-items-center justify-content-center ps-4 pe-4 pt-0">
                                @if(auth()->user()->isMemberOf($group))
                                 <form action="{{ route('groups.join', $group->id) }}" method="POST">
                                        @csrf
                                        <button class="btn btn-success">Gabung Grup</button>
                                    </form>
                                    @else
                                    <form action="{{ route('groups.leave', $group->id) }}" method="POST">
                                        @csrf
                                        <button class="btn btn-danger">Keluar Grup</button>
                                    </form>
                                @endif
                            </div>
                        </div>

                        <!-- Info Grup -->
                        <div class="card w-100 shadow-xss rounded-xxl border-0 mb-3">
                            <div class="card-body d-block p-4">
                                <h4 class="fw-700 mb-3 font-xsss text-grey-900">Tentang Grup</h4>
                                <p class="fw-500 text-grey-500 lh-24 font-xssss mb-0">{{ $group->description }}</p>
                            </div>
                            <div class="card-body border-top-xs d-flex">
                                <i class="feather-users text-grey-500 me-3 font-lg"></i>
                                <h4 class="fw-700 text-grey-900 font-xssss mt-1">{{ $group->members->count() }} Anggota</h4>
                            </div>
                        </div>
                    </div>

                    <!-- Konten Utama -->
                    <div class="col-xl-8 col-xxl-9 col-lg-8">
                        <!-- Buat Postingan -->
                        <div class="card w-100 shadow-xss rounded-xxl border-0 ps-4 pt-4 pe-4 pb-3 mb-3 mt-3">
                            <div class="card-body p-0">
                                <a href="#" class="font-xssss fw-600 text-grey-500 card-body p-0 d-flex align-items-center">
                                    <i class="btn-round-sm font-xs text-primary feather-edit-3 me-2 bg-greylight"></i>Buat
                                    Postingan
                                </a>
                            </div>
                            <div class="card-body p-0 mt-3 position-relative">
                                @if ($photoExists)
                                <figure class="avatar position-absolute ms-2 mt-1 top-5">
                                    <img src="{{ asset('storage/'. $photoPath) }}" alt="image"
                                        class="shadow-sm rounded-circle w30">
                                </figure>
                                @else
                                <figure class="avatar position-absolute ms-2 mt-1 top-5">
                                    <img src="{{ asset('users/avatar.png') }}" alt="image"
                                        class="shadow-sm rounded-circle w30">
                                </figure>
                                @endif
                                <textarea name="message"
                                    class="h100 bor-0 w-100 rounded-xxl p-2 ps-5 font-xssss text-grey-500 fw-500 border-light-md theme-dark-bg"
                                    cols="30" rows="10" placeholder="Apa yang sedang kamu pikirkan?"></textarea>
                            </div>
                        </div>

                        <!-- Daftar Postingan -->
                        {{-- @foreach($group->posts as $post)
                        <div class="card w-100 shadow-xss rounded-xxl border-0 p-4 mb-4">
                            <div class="card-body p-0 d-flex">
                                <figure class="avatar me-3">
                                    <img src="{{ asset('images/user-avatar.jpg') }}" alt="image"
                                        class="shadow-sm rounded-circle w45">
                                </figure>
                                <h4 class="fw-700 text-grey-900 font-xssss mt-1">{{ $post->user->name }}
                                    <span class="d-block font-xssss fw-500 mt-1 lh-3 text-grey-500">{{
                                        $post->created_at->diffForHumans() }}</span>
                                </h4>
                            </div>
                            <div class="card-body p-0 me-lg-5">
                                <p class="fw-500 text-grey-500 lh-26 font-xssss w-100">{{ $post->content }}</p>
                            </div>
                            <div class="card-body d-flex p-0">
                                <a href="#"
                                    class="d-flex align-items-center fw-600 text-grey-900 text-dark lh-26 font-xssss me-3">
                                    <i
                                        class="feather-thumbs-up text-white bg-primary-gradiant me-1 btn-round-xs font-xss"></i>
                                    {{ $post->likes_count }} Suka
                                </a>
                                <a href="#"
                                    class="d-flex align-items-center fw-600 text-grey-900 text-dark lh-26 font-xssss">
                                    <i class="feather-message-circle text-dark text-grey-900 btn-round-sm font-lg"></i> {{
                                    $post->comments_count }} Komentar
                                </a>
                            </div>
                        </div>
                        @endforeach --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection