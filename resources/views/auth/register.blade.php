@extends('auth.layouts.main')
@section('content')
    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-sidebartype="full" data-sidebar-position="fixed"
        data-header-position="fixed">
        <div class="position-relative overflow-hidden radial-gradient min-vh-100">
            <div class="position-relative z-index-5">
                <div class="row">
                    <div class="col-xl-7 col-xxl-8">
                        <a href="index-2.html" class="text-nowrap logo-img d-block px-4 py-9 w-100">
                            <img src="https://demos.adminmart.com/premium/bootstrap/modernize-bootstrap/package/dist/images/logos/dark-logo.svg"
                                width="180" alt="">
                        </a>
                        <div class="d-none d-xl-flex align-items-center justify-content-center"
                            style="height: calc(100vh - 80px);">
                            <img src="https://demos.adminmart.com/premium/bootstrap/modernize-bootstrap/package/dist/images/backgrounds/login-security.svg"
                                alt="" class="img-fluid" width="500">
                        </div>
                    </div>
                    <div class="col-xl-5 col-xxl-4">
                        <div
                            class="authentication-login min-vh-100 bg-body row justify-content-center align-items-center p-4">
                            <div class="col-sm-8 col-md-6 col-xl-9">
                                <h2 class="mb-3 fs-7 fw-bolder">Welcome to StarMar</h2>
                                <p class=" mb-9">Please register to continue</p>

                                <div class="position-relative text-center my-4">
                                    <span
                                        class="border-top w-100 position-absolute top-50 start-50 translate-middle"></span>
                                </div>
                                <form action="{{ route('register') }}" method="POST">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="name" class="form-label">Name</label>
                                        <input type="text" class="form-control" id="name"
                                            aria-describedby="textHelp" name="name" value="{{ old('name') }}">
                                    </div>
                                    <div class="mb-3">
                                        <label for="email" class="form-label">Email address</label>
                                        <input type="email" class="form-control" id="email"
                                            aria-describedby="emailHelp" name="email" value="{{ old('email') }}">
                                    </div>
                                    <div class="mb-4">
                                        <label for="password" class="form-label">Password</label>
                                        <input type="password" class="form-control" id="password" name="password"
                                            value="{{ old('password') }}">
                                    </div>
                                    <button type="submit" class="btn btn-primary w-100 py-8 mb-4 rounded-2">Sign
                                        Up</button>
                                    <div class="d-flex align-items-center">
                                        <p class="fs-4 mb-0 text-dark">Already have an Account?</p>
                                        <a class="text-primary fw-medium ms-2" href="{{ route('register') }}">Sign In</a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
