@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Dashboard</h1>
    <p>Selamat datang di halaman dashboard!</p>
    <h2>Data Postingan</h2>
    <table class="table">
        <thead>
            <tr>
                <th>#</th>
                <th>Judul</th>
                <th>Konten</th>
                <th>Tanggal</th>
            </tr>
        </thead>
        <tbody>
            @foreach($post as $post)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $post->title }}</td>
                <td>{{ $post->content }}</td>
                <td>{{ $post->created_at->format('d-m-Y') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
