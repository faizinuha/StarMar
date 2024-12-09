@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Verifikasi Email Anda</h1>
    <p>Kami telah mengirimkan tautan verifikasi ke email Anda. Silakan cek email Anda untuk memverifikasi akun.</p>

    @if (session('status') == 'verification-link-sent')
        <div class="alert alert-success">
            Tautan verifikasi baru telah dikirim ke alamat email Anda.
        </div>
    @endif

    <form method="POST" action="{{ route('verification.send') }}">
        @csrf
        <button type="submit" class="btn btn-primary">Kirim Ulang Tautan</button>
    </form>
</div>
@endsection
