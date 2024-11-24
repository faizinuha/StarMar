@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="card bg-light-info shadow-none position-relative overflow-hidden">
            <div class="card-body px-4 py-3">
                <div class="row align-items-center">
                    <div class="col-9">
                        <h4 class="fw-semibold mb-8">User Profile</h4>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a class="text-muted " href="index-2.html">Dashboard</a></li>
                                <li class="breadcrumb-item" aria-current="page">User Profile</li>
                            </ol>
                        </nav>
                    </div>
                    <div class="col-3">
                        <div class="text-center mb-n5">
                            <img src="../../dist/images/breadcrumb/ChatBc.png" alt="" class="img-fluid mb-n4">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card overflow-hidden">
            <div class="card-body p-0">
                <img src="../../dist/images/backgrounds/profilebg.jpg" alt="" class="img-fluid">
                <div class="row align-items-center">
                    <div class="col-lg-4 order-lg-1 order-2">
                        <div class="d-flex align-items-center justify-content-around m-4">
                            <div class="text-center">
                                <i class="ti ti-file-description fs-6 d-block mb-2"></i>
                                <h4 class="mb-0 fw-semibold lh-1">0</h4>
                                <p class="mb-0 fs-4">Posts</p>
                            </div>
                            <div class="text-center">
                                <i class="ti ti-user-circle fs-6 d-block mb-2"></i>
                                <h4 class="mb-0 fw-semibold lh-1">0</h4>
                                <p class="mb-0 fs-4">Followers</p>
                            </div>
                            <div class="text-center">
                                <i class="ti ti-user-check fs-6 d-block mb-2"></i>
                                <h4 class="mb-0 fw-semibold lh-1">0</h4>
                                <p class="mb-0 fs-4">Following</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 mt-n3 order-lg-2 order-1">
                        <div class="mt-n5">
                            <div class="d-flex align-items-center justify-content-center mb-2">
                                <div class="linear-gradient d-flex align-items-center justify-content-center rounded-circle"
                                    style="width: 110px; height: 110px;";>
                                    <div class="border border-4 border-white d-flex align-items-center justify-content-center rounded-circle overflow-hidden"
                                        style="width: 100px; height: 100px;";>
                                        <img src="../../dist/images/profile/user-1.jpg" alt="" class="w-100 h-100">
                                    </div>
                                </div>
                            </div>
                            <div class="text-center">
                                <h5 class="fs-5 mb-0 fw-semibold">{{ Auth::user()->name }}</h5>
                                <p class="mb-0 fs-4">Role?</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 order-last">
                        <ul
                            class="list-unstyled d-flex align-items-center justify-content-center justify-content-lg-start my-3 gap-3">
                            <li class="position-relative">
                                <a class="text-white d-flex align-items-center justify-content-center bg-primary p-2 fs-4 rounded-circle"
                                    href="javascript:void(0)" width="30" height="30">
                                    <i class="ti ti-brand-facebook"></i>
                                </a>
                            </li>
                            <li class="position-relative">
                                <a class="text-white bg-secondary d-flex align-items-center justify-content-center p-2 fs-4 rounded-circle "
                                    href="javascript:void(0)">
                                    <i class="ti ti-brand-twitter"></i>
                                </a>
                            </li>
                            <li class="position-relative">
                                <a class="text-white bg-secondary d-flex align-items-center justify-content-center p-2 fs-4 rounded-circle "
                                    href="javascript:void(0)">
                                    <i class="ti ti-brand-dribbble"></i>
                                </a>
                            </li>
                            <li class="position-relative">
                                <a class="text-white bg-danger d-flex align-items-center justify-content-center p-2 fs-4 rounded-circle "
                                    href="javascript:void(0)">
                                    <i class="ti ti-brand-youtube"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <ul class="nav nav-pills user-profile-tab justify-content-end mt-2 bg-light-info rounded-2" id="pills-tab"
                    role="tablist">
                    <li class="nav-item" role="presentation">
                        <button
                            class="nav-link position-relative rounded-0 active d-flex align-items-center justify-content-center bg-transparent fs-3 py-6"
                            id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile" type="button"
                            role="tab" aria-controls="pills-profile" aria-selected="true">
                            <i class="ti ti-user-circle me-2 fs-6"></i>
                            <span class="d-none d-md-block">Profile</span>
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button
                            class="nav-link position-relative rounded-0 d-flex align-items-center justify-content-center bg-transparent fs-3 py-6"
                            id="pills-followers-tab" data-bs-toggle="pill" data-bs-target="#pills-followers" type="button"
                            role="tab" aria-controls="pills-followers" aria-selected="false">
                            <i class="ti ti-heart me-2 fs-6"></i>
                            <span class="d-none d-md-block">Followers</span>
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button
                            class="nav-link position-relative rounded-0 d-flex align-items-center justify-content-center bg-transparent fs-3 py-6"
                            id="pills-friends-tab" data-bs-toggle="pill" data-bs-target="#pills-friends" type="button"
                            role="tab" aria-controls="pills-friends" aria-selected="false">
                            <i class="ti ti-user-circle me-2 fs-6"></i>
                            <span class="d-none d-md-block">Friends</span>
                        </button>
                    </li>
                </ul>
            </div>
        </div>
        <div class="tab-content" id="pills-tabContent">
            <div class="tab-pane fade show active" id="pills-profile" role="tabpanel"
                aria-labelledby="pills-profile-tab" tabindex="0">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="card shadow-none border">
                            <div class="card-body">
                                <h4 class="fw-semibold mb-3">Introduction</h4>
                                <p>Hello, I am Mathew Anderson. I love making websites and graphics. Lorem ipsum dolor sit
                                    amet, consectetur adipiscing elit.</p>
                                <ul class="list-unstyled mb-0">
                                    <li class="d-flex align-items-center gap-3 mb-4">
                                        <i class="ti ti-briefcase text-dark fs-6"></i>
                                        <h6 class="fs-4 fw-semibold mb-0">Sir, P P Institute Of Science</h6>
                                    </li>
                                    <li class="d-flex align-items-center gap-3 mb-4">
                                        <i class="ti ti-mail text-dark fs-6"></i>
                                        <h6 class="fs-4 fw-semibold mb-0">xyzjonathan@gmail.com</h6>
                                    </li>
                                    <li class="d-flex align-items-center gap-3 mb-4">
                                        <i class="ti ti-device-desktop text-dark fs-6"></i>
                                        <h6 class="fs-4 fw-semibold mb-0">www.xyz.com</h6>
                                    </li>
                                    <li class="d-flex align-items-center gap-3 mb-2">
                                        <i class="ti ti-map-pin text-dark fs-6"></i>
                                        <h6 class="fs-4 fw-semibold mb-0">Newyork, USA - 100001</h6>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="card shadow-none border">
                            <div class="card-body">
                                <h4 class="fw-semibold mb-3">Photos</h4>
                                <div class="row">
                                    <div class="col-4">
                                        <img src="../../dist/images/profile/user-1.jpg" alt=""
                                            class="rounded-2 img-fluid mb-9">
                                    </div>
                                    <div class="col-4">
                                        <img src="../../dist/images/profile/user-2.jpg" alt=""
                                            class="rounded-2 img-fluid mb-9">
                                    </div>
                                    <div class="col-4">
                                        <img src="../../dist/images/profile/user-3.jpg" alt=""
                                            class="rounded-2 img-fluid mb-9">
                                    </div>
                                    <div class="col-4">
                                        <img src="../../dist/images/profile/user-4.jpg" alt=""
                                            class="rounded-2 img-fluid mb-9">
                                    </div>
                                    <div class="col-4">
                                        <img src="../../dist/images/profile/user-5.jpg" alt=""
                                            class="rounded-2 img-fluid mb-9">
                                    </div>
                                    <div class="col-4">
                                        <img src="../../dist/images/profile/user-6.jpg" alt=""
                                            class="rounded-2 img-fluid mb-9">
                                    </div>
                                    <div class="col-4">
                                        <img src="../../dist/images/profile/user-7.jpg" alt=""
                                            class="rounded-2 img-fluid mb-6">
                                    </div>
                                    <div class="col-4">
                                        <img src="../../dist/images/profile/user-8.jpg" alt=""
                                            class="rounded-2 img-fluid mb-6">
                                    </div>
                                    <div class="col-4">
                                        <img src="../../dist/images/profile/user-1.jpg" alt=""
                                            class="rounded-2 img-fluid mb-6">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-8">
                        <div class="card border">
                            <div class="px-4 py-3 border-bottom">
                                <h5 class="card-title fw-semibold mb-0">Edit Profil</h5>
                            </div>
                            <form action="{{ route('profile.update') }}" method="post">
                                @csrf
                                @method('patch')
                                <div class="card-body p-4">
                                    <div class="mb-4">
                                        <label for="exampleInputPassword1" class="form-label fw-semibold">Nama</label>
                                        <div class="input-group border rounded-1">
                                            <span class="input-group-text bg-transparent px-6 border-0"
                                                id="basic-addon1"><i class="ti ti-user fs-6"></i></span>
                                            <input type="text" class="form-control border-0 ps-2" name="name"
                                                value="{{ $user->name }}" placeholder="{{ $user->name }}">
                                        </div>
                                    </div>
                                    <div class="mb-4">
                                        <label for="exampleInputPassword1" class="form-label fw-semibold">Email</label>
                                        <div class="input-group border rounded-1">
                                            <span class="input-group-text bg-transparent px-6 border-0"
                                                id="basic-addon1"><i class="ti ti-mail fs-6"></i></span>
                                            <input type="text" class="form-control border-0 ps-2" name="email"
                                                value="{{ $user->email }}" placeholder="{{ $user->email }}">
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-end">
                                        <button class="btn btn-primary">Simpan</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="pills-followers" role="tabpanel" aria-labelledby="pills-followers-tab"
                tabindex="0">
                <div class="d-sm-flex align-items-center justify-content-between mt-3 mb-4">
                    <h3 class="mb-3 mb-sm-0 fw-semibold d-flex align-items-center">Followers <span
                            class="badge text-bg-secondary fs-2 rounded-4 py-1 px-2 ms-2">20</span></h3>
                    <form class="position-relative">
                        <input type="text" class="form-control search-chat py-2 ps-5" id="text-srh"
                            placeholder="Search Followers">
                        <i class="ti ti-search position-absolute top-50 start-0 translate-middle-y text-dark ms-3"></i>
                    </form>
                </div>
            </div>
            <div class="tab-pane fade" id="pills-friends" role="tabpanel" aria-labelledby="pills-friends-tab"
                tabindex="0">
                <div class="d-sm-flex align-items-center justify-content-between mt-3 mb-4">
                    <h3 class="mb-3 mb-sm-0 fw-semibold d-flex align-items-center">Friends <span
                            class="badge text-bg-secondary fs-2 rounded-4 py-1 px-2 ms-2">20</span></h3>
                    <form class="position-relative">
                        <input type="text" class="form-control search-chat py-2 ps-5" id="text-srh"
                            placeholder="Search Friends">
                        <i class="ti ti-search position-absolute top-50 start-0 translate-middle-y text-dark ms-3"></i>
                    </form>
                </div>
            </div>
            <div class="tab-pane fade" id="pills-gallery" role="tabpanel" aria-labelledby="pills-gallery-tab"
                tabindex="0">
                <div class="d-sm-flex align-items-center justify-content-between mt-3 mb-4">
                    <h3 class="mb-3 mb-sm-0 fw-semibold d-flex align-items-center">Gallery <span
                            class="badge text-bg-secondary fs-2 rounded-4 py-1 px-2 ms-2">12</span></h3>
                    <form class="position-relative">
                        <input type="text" class="form-control search-chat py-2 ps-5" id="text-srh"
                            placeholder="Search Friends">
                        <i class="ti ti-search position-absolute top-50 start-0 translate-middle-y text-dark ms-3"></i>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
