   @php
   $user = Auth::user(); // Mendapatkan pengguna yang sedang login
   @endphp
@extends('users.app')
@section('content')
    <div class="main-content bg-lightblue right-chat-active">
        <div class="middle-sidebar-bottom">
            <div class="middle-sidebar-left">
                <div class="middle-wrap">
                    <div class="card w-100 border-0 bg-white shadow-xs p-0 mb-4">
                        <div class="card-body p-lg-5 p-4 w-100 border-0">
                            <div class="row">
                                <div class="col-lg-12">
                                    <h4 class="font-xxl fw-700 mont-font font-md-xs">Settings</h4>
                                    <p>Welcome ✨ {{ $user->first_name }}</p> <!-- Menampilkan first_name pengguna -->
                                    <!-- General Settings -->
                                    <div class="nav-caption fw-600 font-xssss text-grey-500 mb-2">General Settings</div>
                                    <ul class="list-inline mb-4">
                                        <li class="list-inline-item d-block border-bottom me-0">
                                            <a href="{{ route('profile') }}" class="pt-2 pb-2 d-flex align-items-center">
                                                <i
                                                    class="btn-round-md bg-primary-gradiant text-white feather-user font-md me-3"></i>
                                                <h4 class="fw-600 font-xsss mb-0 mt-0">Account Information</h4>
                                                <i class="ti-angle-right font-xsss text-grey-500 ms-auto mt-3"></i>
                                            </a>
                                        </li>
                                        <li class="list-inline-item d-block border-bottom me-0">
                                            <a href="contact-information.html" class="pt-2 pb-2 d-flex align-items-center">
                                                <i
                                                    class="btn-round-md bg-gold-gradiant text-white feather-map-pin font-md me-3"></i>
                                                <h4 class="fw-600 font-xsss mb-0 mt-0">Saved Address</h4>
                                                <i class="ti-angle-right font-xsss text-grey-500 ms-auto mt-3"></i>
                                            </a>
                                        </li>
                                        <li class="list-inline-item d-block me-0">
                                            <a href="social.html" class="pt-2 pb-2 d-flex align-items-center">
                                                <i
                                                    class="btn-round-md bg-red-gradiant text-white feather-twitter font-md me-3"></i>
                                                <h4 class="fw-600 font-xsss mb-0 mt-0">Connected Accounts</h4>
                                                <i class="ti-angle-right font-xsss text-grey-500 ms-auto mt-3"></i>
                                            </a>
                                        </li>
                                    </ul>

                                    <!-- Privacy Settings -->
                                    <div class="nav-caption fw-600 font-xssss text-grey-500 mb-2">Privacy</div>
                                    <ul class="list-inline mb-4">
                                        <li class="list-inline-item d-block border-bottom me-0">
                                            <a href="privacy-settings.html" class="pt-2 pb-2 d-flex align-items-center">
                                                <i
                                                    class="btn-round-md bg-blue-gradiant text-white feather-shield font-md me-3"></i>
                                                <h4 class="fw-600 font-xsss mb-0 mt-0">Privacy Settings</h4>
                                                <i class="ti-angle-right font-xsss text-grey-500 ms-auto mt-3"></i>
                                            </a>
                                        </li>
                                        <li class="list-inline-item d-block me-0">
                                            <a href="blocking.html" class="pt-2 pb-2 d-flex align-items-center">
                                                <i
                                                    class="btn-round-md bg-mini-gradiant text-white feather-slash font-md me-3"></i>
                                                <h4 class="fw-600 font-xsss mb-0 mt-0">Blocking</h4>
                                                <i class="ti-angle-right font-xsss text-grey-500 ms-auto mt-3"></i>
                                            </a>
                                        </li>
                                    </ul>

                                    <!-- Security Settings -->
                                    <div class="nav-caption fw-600 font-xssss text-grey-500 mb-2">Security</div>
                                    <ul class="list-inline mb-4">
                                        <li class="list-inline-item d-block border-bottom me-0">
                                            <a href="password.html" class="pt-2 pb-2 d-flex align-items-center">
                                                <i
                                                    class="btn-round-md bg-blue-gradiant text-white feather-lock font-md me-3"></i>
                                                <h4 class="fw-600 font-xsss mb-0 mt-0">Password</h4>
                                                <i class="ti-angle-right font-xsss text-grey-500 ms-auto mt-3"></i>
                                            </a>
                                        </li>
                                        <li class="list-inline-item d-block me-0">
                                            <a href="two-factor-auth.html" class="pt-2 pb-2 d-flex align-items-center">
                                                <i
                                                    class="btn-round-md bg-red-gradiant text-white feather-key font-md me-3"></i>
                                                <h4 class="fw-600 font-xsss mb-0 mt-0">Two-Factor Authentication</h4>
                                                <i class="ti-angle-right font-xsss text-grey-500 ms-auto mt-3"></i>
                                            </a>
                                        </li>
                                    </ul>

                                    <!-- Other Settings -->
                                    <div class="nav-caption fw-600 font-xssss text-grey-500 mb-2">Other</div>
                                    <ul class="list-inline">
                                        <li class="list-inline-item d-block border-bottom me-0">
                                            <a href="notifications.html" class="pt-2 pb-2 d-flex align-items-center">
                                                <i
                                                    class="btn-round-md bg-gold-gradiant text-white feather-bell font-md me-3"></i>
                                                <h4 class="fw-600 font-xsss mb-0 mt-0">Notification Settings</h4>
                                                <i class="ti-angle-right font-xsss text-grey-500 ms-auto mt-3"></i>
                                            </a>
                                        </li>
                                        <li class="list-inline-item d-block border-bottom me-0">
                                            <a href="help-center.html" class="pt-2 pb-2 d-flex align-items-center">
                                                <i
                                                    class="btn-round-md bg-primary-gradiant text-white feather-help-circle font-md me-3"></i>
                                                <h4 class="fw-600 font-xsss mb-0 mt-0">Help Center</h4>
                                                <i class="ti-angle-right font-xsss text-grey-500 ms-auto mt-3"></i>
                                            </a>
                                        </li>
                                        <li class="list-inline-item d-block me-0">
                                            <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                                class="d-flex align-items-center pt-2 pb-2">
                                                @csrf
                                                <button type="submit"
                                                    class="btn btn-link p-0 d-flex align-items-center text-decoration-none">
                                                    <i
                                                        class="btn-round-md bg-red-gradiant text-white feather-log-out font-md me-3"></i>
                                                    <h4 class="fw-600 font-xsss mb-0 mt-0 text-black">Logout</h4>
                                                    <i class="ti-angle-right font-xsss text-grey-500 ms-auto mt-3"></i>
                                                </button>
                                            </form>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
