@extends('layouts.app')
@section('content')
<table class="table">
  <thead>
      <tr>
          <th>ID</th>
          <th>Reporter</th>
          <th>Reported User/Post</th>
          <th>Category</th>
          <th>Description</th>
          <th>Status</th>
          <th>Actions</th>
      </tr>
  </thead>
  <tbody>
      @foreach ($reports as $report)
      <tr>
          <td>{{ $report->id }}</td>
          <td>{{ $report->name }}</td>
          <td>
              @if($report->reported_user_id)
                  User: {{ $report->reportedUser->name }}
              @elseif($report->reported_post_id)
                  Post ID: {{ $report->reported_post_id }}
              @endif
          </td>
          <td>{{ $report->category }}</td>
          <td>{{ $report->description }}</td>
          <td>{{ $report->status }}</td>
          <td>
              <form action="{{ route('admin.reports.action', $report->id) }}" method="POST">
                  @csrf
                  <button type="submit" class="btn btn-success">Take Action</button>
              </form>
          </td>
      </tr>
      @endforeach
  </tbody>
</table>

@endsection