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
                                    {{Auth::user()->first_name}}
                                    <span class="d-block font-xssss fw-500 mt-1 lh-3 text-grey-500">
                                      {{Auth::user()->last_name}}
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
                            </div>
                            {{-- profile slide --}}
                            @include('profile.profile_slide');
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
                                    <p>Bergabung sejak: {{ Auth::user()->created_at->format('d M Y') }}</p>
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
                  <div class="card shadow-sm p-4">
                      <h3 class="mb-3">Membership Details</h3>
              
                      <!-- Profile Section -->
                      <div class="d-flex align-items-center mb-4">
                          <img src="https://i.pravatar.cc/100" class="rounded-circle me-3" width="80" height="80" alt="User Avatar">
                          <div>
                              <h5 class="mb-1">John Doe</h5>
                              <p class="text-muted">Premium Member</p>
                          </div>
                      </div>
              
                      <!-- Stats -->
                      <div class="row text-center mb-4">
                          <div class="col-md-4">
                              <h5>120</h5>
                              <p class="text-muted">Followers</p>
                          </div>
                          <div class="col-md-4">
                              <h5>56</h5>
                              <p class="text-muted">Following</p>
                          </div>
                          <div class="col-md-4">
                              <h5>34</h5>
                              <p class="text-muted">Posts</p>
                          </div>
                      </div>
              
                      <!-- Membership Details -->
                      <h6 class="fw-bold">Membership Benefits</h6>
                      <ul class="list-unstyled">
                          <li>✅ Access to exclusive content</li>
                          <li>✅ Priority support</li>
                          <li>✅ Verified badge</li>
                          <li>✅ Early access to new features</li>
                      </ul>
              
                      <a href="#" class="btn btn-primary w-100 mt-3">Upgrade Membership</a>
                  </div>
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
