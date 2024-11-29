@extends('users.app')
@section('content')
    <div class="main-content bg-lightblue theme-dark-bg right-chat-active">

        <div class="middle-sidebar-bottom">
            <div class="middle-sidebar-left">
                <div class="middle-wrap">
                    <div class="card w-100 border-0 bg-white shadow-xs p-0 mb-4">

                        <div class="card-body p-lg-5 p-4 w-100 border-0">
                            <div class="row">
                                <div class="col-lg-12">
                                    <h4 class="mb-4 font-xxl fw-700 mont-font mb-lg-5 mb-4 font-md-xs">Settings</h4>
                                    <div class="nav-caption fw-600 font-xssss text-grey-500 mb-2">Genaral</div>
                                    <ul class="list-inline mb-4">
                                        <li class="list-inline-item d-block border-bottom me-0"><a
                                                href="account-information.html"
                                                class="pt-2 pb-2 d-flex align-items-center"><i
                                                    class="btn-round-md bg-primary-gradiant text-white feather-home font-md me-3"></i>
                                                <h4 class="fw-600 font-xsss mb-0 mt-0">Acount Information</h4><i
                                                    class="ti-angle-right font-xsss text-grey-500 ms-auto mt-3"></i>
                                            </a></li>
                                        <li class="list-inline-item d-block border-bottom me-0"><a
                                                href="contact-information.html"
                                                class="pt-2 pb-2 d-flex align-items-center"><i
                                                    class="btn-round-md bg-gold-gradiant text-white feather-map-pin font-md me-3"></i>
                                                <h4 class="fw-600 font-xsss mb-0 mt-0">Saved Address</h4><i
                                                    class="ti-angle-right font-xsss text-grey-500 ms-auto mt-3"></i>
                                            </a></li>
                                        <li class="list-inline-item d-block me-0"><a href="social.html"
                                                class="pt-2 pb-2 d-flex align-items-center"><i
                                                    class="btn-round-md bg-red-gradiant text-white feather-twitter font-md me-3"></i>
                                                <h4 class="fw-600 font-xsss mb-0 mt-0">Social Acount</h4><i
                                                    class="ti-angle-right font-xsss text-grey-500 ms-auto mt-3"></i>
                                            </a></li>
                                    </ul>

                                    <div class="nav-caption fw-600 font-xsss text-grey-500 mb-2">Acount</div>
                                    <ul class="list-inline mb-4">
                                        <li class="list-inline-item d-block border-bottom me-0"><a href="payment.html"
                                                class="pt-2 pb-2 d-flex align-items-center"><i
                                                    class="btn-round-md bg-mini-gradiant text-white feather-credit-card font-md me-3"></i>
                                                <h4 class="fw-600 font-xsss mb-0 mt-0">My Cards</h4><i
                                                    class="ti-angle-right font-xsss text-grey-500 ms-auto mt-3"></i>
                                            </a></li>
                                        <li class="list-inline-item d-block  me-0"><a href="password.html"
                                                class="pt-2 pb-2 d-flex align-items-center"><i
                                                    class="btn-round-md bg-blue-gradiant text-white feather-inbox font-md me-3"></i>
                                                <h4 class="fw-600 font-xsss mb-0 mt-0">Password</h4><i
                                                    class="ti-angle-right font-xsss text-grey-500 ms-auto mt-3"></i>
                                            </a></li>

                                    </ul>

                                    <div class="nav-caption fw-600 font-xsss text-grey-500 mb-2">Other</div>
                                    <ul class="list-inline">
                                        <li class="list-inline-item d-block border-bottom me-0"><a
                                                href="default-notification.html"
                                                class="pt-2 pb-2 d-flex align-items-center"><i
                                                    class="btn-round-md bg-gold-gradiant text-white feather-bell font-md me-3"></i>
                                                <h4 class="fw-600 font-xsss mb-0 mt-0">Notification</h4><i
                                                    class="ti-angle-right font-xsss text-grey-500 ms-auto mt-3"></i>
                                            </a></li>
                                        <li class="list-inline-item d-block border-bottom me-0"><a href="help-box.html"
                                                class="pt-2 pb-2 d-flex align-items-center"><i
                                                    class="btn-round-md bg-primary-gradiant text-white feather-help-circle font-md me-3"></i>
                                                <h4 class="fw-600 font-xsss mb-0 mt-0">Help</h4><i
                                                    class="ti-angle-right font-xsss text-grey-500 ms-auto mt-3"></i>
                                            </a></li>
                                        <li class="list-inline-item d-block me-0">
                                            <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                                class="d-flex align-items-center pt-2 pb-2">
                                                @csrf
                                                <button type="submit"
                                                    class="btn btn-link p-0 d-flex align-items-center text-decoration-none">
                                                    <i
                                                        class="btn-round-md bg-red-gradiant text-white feather-lock font-md me-3"></i>
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