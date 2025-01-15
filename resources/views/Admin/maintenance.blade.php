@extends('layouts.admin')

@section('title', 'Maintenance Management')

@section('content')
<div class="container mt-5">
    <h1 class="mb-4">Maintenance Management</h1>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="card mb-4">
        <div class="card-body">
            <p>Saat ini status Maintenance:</p>
            @if ($isDown)
                <h5 class="text-danger">Aktif</h5>
                <form method="POST" action="{{ route('admin.maintenance.toggle') }}">
                    @csrf
                    <button type="submit" name="disable" class="btn btn-success">Nonaktifkan Maintenance Mode</button>
                </form>
            @else
                <h5 class="text-success">Nonaktif</h5>
                <form method="POST" action="{{ route('admin.maintenance.toggle') }}">
                    @csrf
                    <button type="submit" name="enable" class="btn btn-danger">Aktifkan Maintenance Mode</button>
                </form>
            @endif
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <h5>Riwayat Perubahan Maintenance</h5>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Status</th>
                        <th>Waktu Perubahan</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($logs as $log)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $log->status }}</td>
                            <td>{{ $log->changed_at }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="text-center">Belum ada riwayat perubahan</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
