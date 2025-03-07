<div class="nav-header bg-white shadow-xs border-0">
    <div class="nav-top">
        {{-- <i class="feather-zap text-success display1-size me-2 ms-0"> --}}
            <a href="{{ route('beranda') }}"><img src="{{ asset('StarMar/StarMar-.png') }} "
                    class="display1-size text-success me-2 ms-0 w50 " alt="Logo"><span
                    class="d-inline-block fredoka-font ls-3 fw-600 text-current font-xxl logo-text mb-0">StarMar.
                </span> </a>
            <a href="#" class="mob-menu ms-auto me-2 chat-active-btn"><i
                    class="feather-message-circle text-grey-900 font-sm btn-round-md bg-greylight"></i></a>
            <a href="default-video.html" class="mob-menu me-2"><i
                    class="feather-video text-grey-900 font-sm btn-round-md bg-greylight"></i></a>
            <a href="#" class="me-2 menu-search-icon mob-menu"><i
                    class="feather-search text-grey-900 font-sm btn-round-md bg-greylight"></i></a>
            <button class="nav-menu me-0 ms-2"></button>
    </div>

    <form action="#" class="float-left header-search">
        <div class="form-group mb-0 icon-input">
            <i class="feather-search font-sm text-grey-400"></i>
            <input type="text" placeholder="Start typing to search.."
                class="bg-grey border-0 lh-32 pt-2 pb-2 ps-5 pe-3 font-xssss fw-500 rounded-xl w350 theme-dark-bg">
        </div>
    </form>
    @if(auth()->user()->hasRole('admin'))
        <a href="{{ route('dashboard') }}" class="p-2 text-center ms-3 menu-icon center-menu-icon">
            <i class="feather-home font-lg alert-primary btn-round-lg theme-dark-bg text-current"></i>
        </a>
    @elseif(auth()->user()->hasRole('user'))
        <a href="{{ route('beranda') }}" class="p-2 text-center ms-3 menu-icon center-menu-icon">
            <i class="feather-home font-lg alert-primary btn-round-lg theme-dark-bg text-current"></i>
        </a>
    @else
        <p>Role tidak dikenal</p>
    @endif
    <!-- Tombol yang memicu modal -->
    <a href="{{route('posts.create')}}" class="p-2 text-center ms-3 menu-icon center-menu-icon">
        <i class="feather-plus font-lg alert-primary btn-round-lg theme-dark-bg text-current"></i>
    </a>
 
    {{-- <a href="default-storie.html" class="p-2 text-center ms-0 menu-icon center-menu-icon"><i
            class="feather-zap font-lg bg-greylight btn-round-lg theme-dark-bg text-grey-500 "></i></a> --}}
    <a href="default-video.html" class="p-2 text-center ms-0 menu-icon center-menu-icon"><i
            class="feather-video font-lg bg-greylight btn-round-lg theme-dark-bg text-grey-500 "></i></a>
    <a href="{{route('groups.index')}}" class="p-2 text-center ms-0 menu-icon center-menu-icon"><i
            class="feather-user font-lg bg-greylight btn-round-lg theme-dark-bg text-grey-500 "></i></a>
    <a href="shop-2.html" class="p-2 text-center ms-0 menu-icon center-menu-icon"><i
            class="feather-shopping-bag font-lg bg-greylight btn-round-lg theme-dark-bg text-grey-500 "></i></a>

    <a href="#" class="p-2 text-center ms-auto menu-icon" id="dropdownMenu3" data-bs-toggle="dropdown"
        aria-expanded="false">
        @if (Auth::user()->unreadNotifications->count() > 0)
            <span class="badge bg-danger">
                {{ Auth::user()->unreadNotifications->count() }}
            </span>
        @endif
        <i class="feather-bell font-xl text-current"></i>
    </a>

    <div class="dropdown-menu dropdown-menu-end p-4 rounded-3 border-0 shadow-lg" aria-labelledby="dropdownMenu3">
        <h4 class="fw-700 font-xss mb-4">Notification</h4>

        @foreach (Auth::user()->unreadNotifications as $notification)
                <div class="card bg-transparent-card w-100 border-0 ps-5 mb-3">
                    <img src="{{ asset('dist2/images/user-8.png') }}" alt="user" class="w40 position-absolute left-0">
                    <h5 class="font-xsss text-grey-900 mb-1 mt-0 fw-700 d-block">
                        {{ $notification->data['follower_name'] }}
                        <span class="text-grey-400 font-xsssss fw-600 float-right mt-1">
                            {{ $notification->created_at->diffForHumans() }} <!-- Waktu relatif -->
                        </span>
                    </h5>
                    <h6 class="text-grey-500 fw-500 font-xssss lh-4">
                        {{ $notification->data['message'] ?? 'Anda memiliki pengikut baru.' }}
                    </h6>
                </div>

                <!-- Menandai notifikasi sebagai telah dibaca -->
                @php
                    $notification->markAsRead();
                @endphp
        @endforeach

        @if (Auth::user()->unreadNotifications->isEmpty())
            <p class="text-grey-500">Tidak ada notifikasi baru.</p>
        @endif
    </div>


    <a href="#" class="p-2 text-center ms-3 menu-icon chat-active-btn"><i
            class="feather-message-square font-xl text-current"></i></a>
    <div class="p-2 text-center ms-3 position-relative dropdown-menu-icon menu-icon cursor-pointer">
        <i class="feather-settings animation-spin d-inline-block font-xl text-current"></i>
        <div class="dropdown-menu-settings switchcolor-wrap">
            <h4 class="fw-700 font-sm mb-4">Settings</h4>
            <h6 class="font-xssss text-grey-500 fw-700 mb-3 d-block">Choose Color Theme</h6>
            <ul>
                <li>
                    <label class="item-radio item-content">
                        <input type="radio" name="color-radio" value="red" checked=""><i class="ti-check"></i>
                        <span class="circle-color bg-red" style="background-color: #ff3b30;"></span>
                    </label>
                </li>
                <li>
                    <label class="item-radio item-content">
                        <input type="radio" name="color-radio" value="green"><i class="ti-check"></i>
                        <span class="circle-color bg-green" style="background-color: #4cd964;"></span>
                    </label>
                </li>
                <li>
                    <label class="item-radio item-content">
                        <input type="radio" name="color-radio" value="blue" checked=""><i class="ti-check"></i>
                        <span class="circle-color bg-blue" style="background-color: #132977;"></span>
                    </label>
                </li>
                <li>
                    <label class="item-radio item-content">
                        <input type="radio" name="color-radio" value="pink"><i class="ti-check"></i>
                        <span class="circle-color bg-pink" style="background-color: #ff2d55;"></span>
                    </label>
                </li>
                </li>
            </ul>

            <div class="card bg-transparent-card border-0 d-block mt-3">
                <h4 class="d-inline font-xssss mont-font fw-700">Header Background</h4>
                <div class="d-inline float-right mt-1">
                    <label class="toggle toggle-menu-color"><input type="checkbox"><span
                            class="toggle-icon"></span></label>
                </div>
            </div>
            <div class="card bg-transparent-card border-0 d-block mt-3">
                <h4 class="d-inline font-xssss mont-font fw-700">Menu Position</h4>
                <div class="d-inline float-right mt-1">
                    <label class="toggle toggle-menu"><input type="checkbox"><span class="toggle-icon"></span></label>
                </div>
            </div>
            <div class="card bg-transparent-card border-0 d-block mt-3">
                <h4 class="d-inline font-xssss mont-font fw-700">Dark Mode</h4>
                <div class="d-inline float-right mt-1">
                    <label class="toggle toggle-dark"><input type="checkbox"><span class="toggle-icon"></span></label>
                </div>
            </div>

        </div>
    </div>

    @php
        $photoPath = Auth::check() ? Auth::user()->photo_profile : null; // Path foto profil jika user login
        $photoExists = $photoPath && file_exists(public_path('storage/' . $photoPath)); // Cek file
    @endphp

    <a href="{{ route('user.setting') }}" class="p-0 ms-3 menu-icon">
        @if ($photoExists)
            <img src="{{ asset('storage/' . $photoPath) }}" alt="user" style="border-radius: 50px"
                class="rounded-sm w40 mt--1">
        @else
            <img src="{{ asset('users/avatar.png') }}" alt="user" style="border-radius: 50px" class="rounded-sm w40 mt--1">
        @endif
    </a>

</div>