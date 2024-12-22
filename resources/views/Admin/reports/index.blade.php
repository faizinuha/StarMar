@extends('layouts.admin')

@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-12">
            <h3 class="text-center mb-4">Manajemen Laporan</h3>
        </div>
        
        <!-- Tabel Laporan Pending -->
        <div class="col-12">
            <h5 class="mb-3">Laporan Pending</h5>
            <table class="table table-bordered table-hover">
                <thead class="table-light">
                    <tr>
                        <th>ID</th>
                        <th>Reporter</th>
                        <th>User/Post</th>
                        <th>Category</th>
                        <th>Description</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pendingReports as $report)
                        <tr>
                          <td>{{ $loop->iteration }}</td>
                            <td>{{ $report->reporter->first_name }}</td>
                            <td>
                                @if ($report->reported_user_id)
                                    User: {{ $report->reportedUser->first_name }}
                                @elseif ($report->reported_post_id)
                                    Post ID: {{ $report->reported_post_id }}
                                @endif
                            </td>
                            <td>{{ $report->category }}</td>
                            <td>{{ $report->description }}</td>
                            <td>
                                <a href="{{ route('admin.reports.actionPage', $report->id) }}" class="btn btn-sm btn-primary">Take Action</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Tabel Laporan Reviewed -->
        <div class="col-12 mt-4">
            <h5 class="mb-3">Laporan Reviewed</h5>
            <table class="table table-bordered table-hover">
                <thead class="table-light">
                    <tr>
                        <th>ID</th>
                        <th>Reporter</th>
                        <th>User/Post</th>
                        <th>Category</th>
                        <th>Description</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($reviewedReports as $report)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $report->reporter->first_name }}</td>
                            <td>
                                @if ($report->reported_user_id)
                                    User: {{ $report->reportedUser->first_name }}
                                @elseif ($report->reported_post_id)
                                    Post ID: {{ $report->reported_post_id }}
                                @endif
                            </td>
                            <td>{{ $report->category }}</td>
                            <td>{{ $report->description }}</td>
                            <td>{{ $report->status }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
