@extends('users.app')
@section(section: 'content')

@php
$photoPath = Auth::check() ? Auth::user()->photo_profile : null; // Path foto profil jika user login
$photoExists = $photoPath && file_exists(public_path('storage/' . $photoPath)); // Cek file
@endphp

    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <div class="main-content right-chat-active">

        <div class="middle-sidebar-bottom">
            <div class="middle-sidebar-left">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="card w-100 shadow-xss rounded-xxl border-0 mb-3 mt-3 overflow-hidden">
                            <div class="card-body position-relative h240 bg-image-cover bg-image-center"
                                style="background-image: url('{{ asset('dist2/images/bb-9.jpg') }}');"></div>
                            <div class="card-body d-block pt-4 text-center position-relative">
                                <figure class="avatar mt--6 position-relative w75 z-index-1 w100 z-index-1 ms-auto me-auto">
                                    @if ($photoExists)
                                        <!-- Menampilkan foto profil yang diunggah pengguna -->
                                        <img src="{{ asset('storage/' . $photoPath) }}" alt="Profile Photo"
                                            class="p-1 bg-white rounded-xl w-100">
                                    @else
                                        <!-- Menampilkan foto profil default (jika belum diunggah) -->
                                        <img src="{{ asset('users/avatar.png') }}" alt="Default Profile Photo"
                                            class="p-1 bg-white rounded-xl w-100">
                                    @endif
                                </figure>


                                <h4 class="font-xs ls-1 fw-700 text-grey-900">
                                    {{ $user->first_name }}
                                    <span class="d-block font-xssss fw-500 mt-1 lh-3 text-grey-500">
                                        {{ $user->last_name }}
                                    </span>
                                </h4>
                                <div class="d-flex align-items-center pt-0 position-absolute left-15 top-10 mt-4 ms-2">
                                    <h4 class="font-xsssss text-center d-none d-lg-block text-grey-500 fw-600 ms-2 me-2"><b
                                            class="text-grey-900 mb-1 font-sm fw-700 d-inline-block ls-3 text-dark">{{ $postCount }}
                                        </b> Posts</h4>
                                    <h4 class="font-xsssss text-center d-none d-lg-block text-grey-500 fw-600 ms-2 me-2"><b
                                            class="text-grey-900 mb-1 font-sm fw-700 d-inline-block ls-3 text-dark">{{ $followersCount }}
                                        </b> Followers</h4>
                                    <h4 class="font-xsssss text-center d-none d-lg-block text-grey-500 fw-600 ms-2 me-2"><b
                                            class="text-grey-900 mb-1 font-sm fw-700 d-inline-block ls-3 text-dark">{{ $followingCount }}
                                        </b> Follow</h4>
                                </div>
                                <form action="{{ route('profile.update_picture') }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <input type="file" name="photo" id="photo" accept="image/*" capture="camera"
                                        class="form-control" style="display: none;" onchange="this.form.submit()">
                                </form>
                                {{-- <livewire:follows :user="$user" /> --}}
                                <div
                                    class="d-flex align-items-center justify-content-center position-absolute right-15 top-10 mt-2 me-2">
                                    @if (Auth::id() !== $user->id)
                                        <!-- Tombol hanya muncul jika melihat profil orang lain -->
                                        @if (Auth::user()->followings->contains($user->id))
                                            <form action="{{ route('unfollow', $user) }}" method="POST"
                                                style="display: inline;">
                                                @csrf
                                                <button type="submit"
                                                    class="btn btn-danger d-none d-lg-block p-3 z-index-1 rounded-3 text-white font-xsssss text-uppercase fw-700 ls-3">
                                                    Unfollow
                                                </button>
                                            </form>
                                        @else
                                            <form action="{{ route('follow', $user) }}" method="POST"
                                                style="display: inline;">
                                                @csrf
                                                <button type="submit"
                                                    class="btn btn-primary d-none d-lg-block p-3 z-index-1 rounded-3 text-white font-xsssss text-uppercase fw-700 ls-3">
                                                    Follow
                                                </button>
                                            </form>
                                        @endif
                                    @endif

                                    <!-- Tombol pesan (email) -->
                                    <a href="#"
                                        class="d-none d-lg-block bg-greylight btn-round-lg ms-2 rounded-3 text-grey-700">
                                        <i class="feather-mail font-md"></i>
                                    </a>

                                    <!-- Tombol dropdown -->
                                    <a href="#" id="dropdownMenu8"
                                        class="d-none d-lg-block btn-round-lg ms-2 rounded-3 text-grey-700 bg-greylight"
                                        data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="ti-more font-md"></i>
                                    </a>

                                    <!-- Menu dropdown -->
                                    <div class="dropdown-menu dropdown-menu-end p-4 rounded-xxl border-0 shadow-lg dropup"
                                        aria-labelledby="dropdownMenu8">
                                        <!-- Item 1: Save Link -->
                                        <div class="card-body p-0 d-flex">
                                            <label for="photo" class="btn btn-primary btn-sm rounded-circle">
                                                <i class="bi bi-pencil-fill"></i>
                                            </label>
                                        </div>
                                        <div class="card-body p-0 d-flex">
                                            <i class="feather-bookmark text-grey-500 me-3 font-lg"></i>
                                            <h4 class="fw-600 text-grey-900 font-xssss mt-0 me-0">
                                                Save Link
                                                <span class="d-block font-xsssss fw-500 mt-1 lh-3 text-grey-500">Add this to
                                                    your saved items</span>
                                            </h4>
                                        </div>

                                        <!-- Item 2: Hide Post -->
                                        <div class="card-body p-0 d-flex mt-2">
                                            <i class="feather-alert-circle text-grey-500 me-3 font-lg"></i>
                                            <h4 class="fw-600 text-grey-900 font-xssss mt-0 me-0">
                                                Hide Post
                                                <span class="d-block font-xsssss fw-500 mt-1 lh-3 text-grey-500">Save to
                                                    your saved items</span>
                                            </h4>
                                        </div>

                                        <!-- Item 3: Hide all from Group -->
                                        <div class="card-body p-0 d-flex mt-2">
                                            <i class="feather-alert-octagon text-grey-500 me-3 font-lg"></i>
                                            <h4 class="fw-600 text-grey-900 font-xssss mt-0 me-0">
                                                Hide all from Group
                                                <span class="d-block font-xsssss fw-500 mt-1 lh-3 text-grey-500">Save to
                                                    your saved items</span>
                                            </h4>
                                        </div>

                                        <!-- Item 4: Unfollow Group -->
                                        <div class="card-body p-0 d-flex mt-2">
                                            <i class="feather-lock text-grey-500 me-3 font-lg"></i>
                                            <h4 class="fw-600 mb-0 text-grey-900 font-xssss mt-0 me-0">
                                                Unfollow Group
                                                <span class="d-block font-xsssss fw-500 mt-1 lh-3 text-grey-500">Save to
                                                    your saved items</span>
                                            </h4>
                                        </div>
                                    </div>
                                </div>


                            </div>

                            <div class="card-body d-block w-100 shadow-none mb-0 p-0 border-top-xs">
                                <ul class="nav nav-tabs h55 d-flex product-info-tab border-bottom-0 ps-4" id="pills-tab"
                                    role="tablist">
                                    <li class="active list-inline-item me-5"><a
                                            class="fw-700 font-xssss text-grey-500 pt-3 pb-3 ls-1 d-inline-block active"
                                            href="/profile/about" data-toggle="tab">About</a></li>
                                    <li class="list-inline-item me-5"><a
                                            class="fw-700 font-xssss text-grey-500 pt-3 pb-3 ls-1 d-inline-block"
                                            href="/profile/membership" data-toggle="tab">Membership</a></li>
                                    <li class="list-inline-item me-5"><a
                                            class="fw-700 font-xssss text-grey-500 pt-3 pb-3 ls-1 d-inline-block"
                                            href="#navtabs3" data-toggle="tab">Discussion</a></li>
                                    <li class="list-inline-item me-5"><a
                                            class="fw-700 font-xssss text-grey-500 pt-3 pb-3 ls-1 d-inline-block"
                                            href="#navtabs4" data-toggle="tab">Video</a></li>
                                    <li class="list-inline-item me-5"><a
                                            class="fw-700 font-xssss text-grey-500 pt-3 pb-3 ls-1 d-inline-block"
                                            href="#navtabs3" data-toggle="tab">Group</a></li>
                                    <li class="list-inline-item me-5"><a
                                            class="fw-700 font-xssss text-grey-500 pt-3 pb-3 ls-1 d-inline-block"
                                            href="#navtabs1" data-toggle="tab">Events</a></li>
                                    <li class="list-inline-item me-5"><a
                                            class="fw-700 me-sm-5 font-xssss text-grey-500 pt-3 pb-3 ls-1 d-inline-block"
                                            href="#navtabs7" data-toggle="tab">Media</a></li>
                                    <li class="list-inline-item ms-auto mt-3 me-4"><a href="#" class=""><i
                                                class="ti-more-alt text-grey-500 font-xs"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-xxl-3 col-lg-4 pe-0">
                        <div class="card w-100 shadow-xss rounded-xxl border-0 mb-3">
                            <div class="card-body d-block p-4">
                                <h4 class="fw-700 mb-3 font-xsss text-grey-900">About</h4>
                                <p class="fw-500 text-grey-500 lh-24 font-xssss mb-0">Lorem ipsum dolor sit amet,
                                    consectetur adipiscing elit. Morbi nulla dolor, ornare at commodo non, feugiat non nisi.
                                    Phasellus faucibus mollis pharetra. Proin blandit ac massa sed rhoncus</p>
                                <small>
                                    <p>Bergabung sejak: {{ $user->created_at->format('d M Y') }}</p>
                                </small>
                            </div>
                            <div class="card-body border-top-xs d-flex">
                                <i class="feather-lock text-grey-500 me-3 font-lg"></i>
                                <h4 class="fw-700 text-grey-900 font-xssss mt-0">Private <span
                                        class="d-block font-xssss fw-500 mt-1 lh-3 text-grey-500">What's up, how are
                                        you?</span></h4>
                            </div>

                            <div class="card-body d-flex pt-0">
                                <i class="feather-eye text-grey-500 me-3 font-lg"></i>
                                <h4 class="fw-700 text-grey-900 font-xssss mt-0">Visble <span
                                        class="d-block font-xssss fw-500 mt-1 lh-3 text-grey-500">Anyone can find
                                        you</span></h4>
                            </div>
                            <div class="card-body d-flex pt-0">
                                <i class="feather-map-pin text-grey-500 me-3 font-lg"></i>
                                <h4 class="fw-700 text-grey-900 font-xssss mt-1">Flodia, Austia </h4>
                            </div>
                            <div class="card-body d-flex pt-0">
                                <i class="feather-users text-grey-500 me-3 font-lg"></i>
                                <h4 class="fw-700 text-grey-900 font-xssss mt-1">Genarel Group</h4>
                            </div>
                        </div>
                        <div class="card w-100 shadow-xss rounded-xxl border-0 mb-3">
                            <div class="card-body d-flex align-items-center  p-4">
                                <h4 class="fw-700 mb-0 font-xssss text-grey-900">Photos</h4>
                                <a href="#" class="fw-600 ms-auto font-xssss text-primary">See all</a>
                            </div>
                            <div class="card-body d-block pt-0 pb-2">
                                <div class="row">
                                    <div class="col-6 mb-2 pe-1"><a href="{{ asset('dist2/images/e-2.jpg') }}"
                                            data-lightbox="roadtrip"><img src="{{ asset('dist2/images/e-2.jpg') }}"
                                                alt="image" class="img-fluid rounded-3 w-100"></a></div>
                                    <div class="col-6 mb-2 ps-1"><a href="{{ asset('dist2/images/e-3.jpg') }}"
                                            data-lightbox="roadtrip"><img src="{{ asset('dist2/images/e-3.jpg') }}"
                                                alt="image" class="img-fluid rounded-3 w-100"></a></div>
                                    <div class="col-6 mb-2 pe-1"><a href="{{ asset('dist2/images/e-4.jpg') }}"
                                            data-lightbox="roadtrip"><img src="{{ asset('dist2/images/e-4.jpg') }}"
                                                alt="image" class="img-fluid rounded-3 w-100"></a></div>
                                    <div class="col-6 mb-2 ps-1"><a href="{{ asset('dist2/images/e-5.jpg') }}"
                                            data-lightbox="roadtrip"><img src="{{ asset('dist2/images/e-5.jpg') }}"
                                                alt="image" class="img-fluid rounded-3 w-100"></a></div>
                                    <div class="col-6 mb-2 pe-1"><a href="{{ asset('dist2/images/e-2.jpg') }}"
                                            data-lightbox="roadtrip"><img src="{{ asset('dist2/images/e-2.jpg') }}"
                                                alt="image" class="img-fluid rounded-3 w-100"></a></div>
                                    <div class="col-6 mb-2 ps-1"><a href="{{ asset('dist2/images/e-1.jpg') }}"
                                            data-lightbox="roadtrip"><img src="{{ asset('dist2/images/e-1.jpg') }}"
                                                alt="image" class="img-fluid rounded-3 w-100"></a></div>
                                </div>
                            </div>
                            <div class="card-body d-block w-100 pt-0">
                                <a href="#"
                                    class="p-2 lh-28 w-100 d-block bg-grey text-grey-800 text-center font-xssss fw-700 rounded-xl"><i
                                        class="feather-external-link font-xss me-2"></i> More</a>
                            </div>
                        </div>

                        <div class="card w-100 shadow-xss rounded-xxl border-0 mb-3">
                            <div class="card-body d-flex align-items-center p-4">
                                <h4 class="fw-700 mb-0 font-xssss text-grey-900">Di Ikuti</h4>
                                <a href="#" class="fw-600 ms-auto font-xssss text-primary">See all</a>
                            </div>
                            <div class="card-body pt-0 ps-4 pe-4 pb-3">
                                <div class="row">
                                    @php
                                        // Ambil pengguna yang mengikuti saya
                                        $followings = auth()->user()->followings;
                                        $totalfollowings = $followings ? count($followings) : 0;
                                    @endphp

                                    @foreach ($followings as $index => $follower)
                                        @php
                                            $photoPath = $follower->photo_profile; // Path foto profil
                                            $photoExists = $photoPath && file_exists(public_path('storage/' . $photoPath)); // Cek dengan file_exists
                                        @endphp

                                        <!-- Jika pengguna ke-9 -->
                                        @if ($index === 8 && $totalfollowings > 9)
                                            <div class="col-4 mb-3">
                                                <div class="position-relative">
                                                    @if ($photoExists)
                                                        <img src="{{ asset('storage/' . $photoPath) }}" alt="{{ $follower->name }}"
                                                            class="shadow-sm rounded-circle w-100">
                                                    @else
                                                        <img src="{{ asset('users/avatar.png') }}" alt="{{ $follower->name }}"
                                                            class="shadow-sm rounded-circle w-100">
                                                    @endif
                                                    <div class="position-absolute top-50 start-50 translate-middle bg-dark text-white fw-bold rounded-circle d-flex justify-content-center align-items-center"
                                                        style="width: 40px; height: 40px; z-index: 2;">
                                                        +{{ $totalfollowings - 9 }}
                                                    </div>
                                                </div>
                                            </div>
                                        @break
                                    @endif

                                    <!-- Gambar follower -->
                                    <div class="col-4 mb-3">
                                        <div class="position-relative">
                                            @if ($photoExists)
                                                <img src="{{ asset('storage/' . $photoPath) }}" alt="{{ $follower->name }}"
                                                    class="shadow-sm rounded-circle w-100">
                                            @else
                                                <img src="{{ asset('users/avatar.png') }}" alt="{{ $follower->name }}"
                                                    class="shadow-sm rounded-circle w-100">
                                            @endif
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-8 col-xxl-9 col-lg-8">
                    @forelse ($posts as $p)
                        <div class="card w-100 shadow-xss rounded-xxl border-0 p-4 mb-3">
                            <!-- Header: Nama dan Waktu Post -->
                            <div class="card-body p-0 d-flex">
                                <figure class="avatar me-3">
                                    <img src="{{ $p->user->photo_profile ? asset('storage/' . $p->user->photo_profile) : asset('users/avatar.png') }}"
                                        alt="image" class="shadow-sm rounded-circle w45">
                                </figure>
                                <h4 class="fw-700 text-grey-900 font-xssss mt-1">
                                    {{ $p->user->first_name }}
                                    <span class="d-block font-xssss fw-500 mt-1 lh-3 text-grey-500">
                                        {{ $p->created_at->diffForHumans() }}
                                    </span>
                                </h4>
                                <a href="#" class="ms-auto" id="dropdownMenu21" data-toggle="dropdown"
                                    aria-haspopup="true" aria-expanded="false">
                                    <i class="ti-more-alt text-grey-900 btn-round-md bg-greylight font-xss"></i>
                                </a>
                            </div>

                            <!-- Konten Post -->
                            <div class="card-body p-0 me-lg-5">
                                <p class="fw-500 text-grey-500 lh-26 font-xssss w-100">
                                    {{ Str::limit($p->content, 150) }}
                                    <a href="javascript:void(0)" class="fw-600 text-primary ms-2" id="seeMoreBtn">See
                                        more</a>
                                </p>
                            </div>

                            <!-- Bagian yang akan menjadi tujuan scroll -->
                            <div id="fullContent" style="display: none;">
                                <p class="fw-500 text-grey-500 lh-26 font-xssss w-100">
                                    {{ $p->content }}
                                </p>
                            </div>

                            <script>
                                document.getElementById('seeMoreBtn').addEventListener('click', function() {
                                    // Tampilkan konten penuh
                                    document.getElementById('fullContent').style.display = 'block';

                                    // Gulir ke bawah ke elemen fullContent
                                    document.getElementById('fullContent').scrollIntoView({
                                        behavior: 'smooth'
                                    });
                                });
                            </script>


                            <!-- Gambar Post -->
                            <div class="card-body d-block p-0">
                                <div class="row ps-2 pe-2">
                                    @foreach ($posts as $p)
                                        <div class="col-xs-4 col-sm-4 p-1">
                                            <a href="#">
                                                <img src="{{ asset('storage/' . $p->image) }}"
                                                    class="rounded-3 w-100" alt="image">
                                            </a>
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                            <!-- Footer: Like, Comment, dan Share -->
                            <div class="card-body d-flex p-0 mt-3">
                                <a href="#"
                                    class="d-flex align-items-center fw-600 text-grey-900 text-dark lh-26 font-xssss me-3">
                                    <i
                                        class="feather-thumbs-up text-white bg-primary-gradiant me-1 btn-round-xs font-xss"></i>
                                    <i class="feather-heart text-white bg-red-gradiant me-2 btn-round-xs font-xss"></i>
                                    {{ $p->likes->count() }} Like
                                </a>
                                <a href="#"
                                    class="d-flex align-items-center fw-600 text-grey-900 text-dark lh-26 font-xssss">
                                    <i class="feather-message-circle text-dark text-grey-900 btn-round-sm font-lg"></i>
                                    {{ $p->comments->count() }} Comment
                                </a>
                                <a href="#"
                                    class="ms-auto d-flex align-items-center fw-600 text-grey-900 text-dark lh-26 font-xssss">
                                    <i class="feather-share-2 text-grey-900 text-dark btn-round-sm font-lg"></i>
                                    <span class="d-none-xs">Share</span>
                                </a>
                            </div>
                        </div>
                    @empty
                        <small>
                            <p>No posts available</p>
                        </small>
                    @endforelse
                </div>
            </div>
        </div>

    </div>
</div>
<!-- Pastikan jQuery dan Bootstrap JS terpasang dengan benar -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
{{-- <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.1.0/js/bootstrap.bundle.min.js"></script> --}}
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
    integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
    integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous">
</script>

@endsection
