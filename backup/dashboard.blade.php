@extends('layouts.app')
@section('content')
<div class="container mt-4">
    <div class="row">
        <!-- Card 1 -->
        <div class="col-lg-3 col-md-6 mb-4">
            <div class="card shadow-sm">
                <div class="card-body">
                    <i class="ti ti-home fs-2 text-primary"></i>
                    <h5 class="card-title mt-3">Home</h5>
                    <p class="card-text">Akses halaman utama untuk melihat informasi terkini.</p>
                    <a href="{{ route('beranda') }}" class="btn btn-primary btn-sm">Go to Home</a>
                </div>
            </div>
        </div>

        <!-- Card 2 -->
        <div class="col-lg-3 col-md-6 mb-4">
            <div class="card shadow-sm">
                <div class="card-body">
                    <i class="ti ti-package fs-2 text-success"></i>
                    <h5 class="card-title mt-3">Data Postingan</h5>
                    <p class="card-text">Data Postingan:{{ $posts }}</p>
                    <a href="index2.html" class="btn btn-success btn-sm">View Posts</a>
                </div>
            </div>
        </div>

        <!-- Card 3 -->
        <div class="col-lg-3 col-md-6 mb-4">
            <div class="card shadow-sm">
                <div class="card-body">
                    <i class="ti ti-upload fs-2 text-warning"></i>
                    <h5 class="card-title mt-3">Uploads</h5>
                    <p class="card-text">Kelola semua unggahan Anda di sini.</p>
                    <a href="index3.html" class="btn btn-warning btn-sm">Manage Uploads</a>
                </div>
            </div>
        </div>

        <!-- Card 4 -->
        <div class="col-lg-3 col-md-6 mb-4">
            <div class="card shadow-sm">
                <div class="card-body">
                    <i class="ti ti-bell fs-2 text-danger"></i>
                    <h5 class="card-title mt-3">Notification Reports</h5>
                    <p class="card-text">Pantau semua notifikasi dan laporan terbaru.</p>
                    <a href="index4.html" class="btn btn-danger btn-sm">View Notifications</a>
                </div>
            </div>
        </div>

        <!-- Card 5 -->
        <div class="col-lg-3 col-md-6 mb-4">
            <div class="card shadow-sm">
                <div class="card-body">
                    <i class="ti ti-user fs-2 text-info"></i>
                    <h5 class="card-title mt-3">Account</h5>
                    <p class="card-text">Account Users:{{ $user }}.</p>
                    <a href="{{route('Account.index')}}" class="btn btn-info btn-sm">Manage Account</a>
                </div>
            </div>
        </div>

        <!-- Card 6 -->
        <div class="col-lg-3 col-md-6 mb-4">
            <div class="card shadow-sm">
                <div class="card-body">
                    <i class="ti ti-database fs-2 text-dark"></i>
                    <h5 class="card-title mt-3">Account Backup</h5>
                    <p class="card-text">Backup data akun Anda dengan aman.</p>
                    <a href="index5.html" class="btn btn-dark btn-sm">Backup Account</a>
                </div>
            </div>
        </div>

        <!-- Card 7 -->
        <div class="col-lg-3 col-md-6 mb-4">
            <div class="card shadow-sm">
                <div class="card-body">
                    <i class="ti ti-device-gamepad fs-2 text-primary"></i>
                    <h5 class="card-title mt-3">Games</h5>
                    <p class="card-text">Nikmati berbagai games seru di halaman ini.</p>
                    <a href="index6.html" class="btn btn-primary btn-sm">Play Games</a>
                </div>
            </div>
        </div>

        <!-- Card 8 -->
        <div class="col-lg-3 col-md-6 mb-4">
            <div class="card shadow-sm">
                <div class="card-body">
                    <i class="ti ti-playlist fs-2 text-success"></i>
                    <h5 class="card-title mt-3">Playlist</h5>
                    <p class="card-text">Kelola playlist favorit Anda dengan mudah.</p>
                    <a href="index7.html" class="btn btn-success btn-sm">View Playlist</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
