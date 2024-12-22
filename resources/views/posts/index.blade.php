@extends('layouts.admin')

@section('content')
<script src="https://cdn.tailwindcss.com"></script>
<link href="https://cdn.jsdelivr.net/npm/@tabler/icons@2.35.0/iconfont/tabler-icons.min.css" rel="stylesheet">

<div class="container mx-auto py-10">
    <div class="bg-white shadow rounded-lg overflow-hidden">
        <div class="bg-gradient-to-r from-blue-500 to-purple-500 text-white text-center py-4">
            <h4 class="text-lg font-semibold">Data Postingan</h4>
        </div>
        <div class="p-6">
            @if ($posts->isEmpty())
                <p class="text-center text-gray-500 text-lg">Tidak ada data postingan.</p>
            @else
                <div class="overflow-x-auto">
                    <table class="min-w-full border border-gray-200 rounded-lg">
                        <thead class="bg-blue-100">
                            <tr>
                                <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">#</th>
                                <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">Nama</th>
                                <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">Gambar</th>
                                <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">Konten</th>
                                <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">Video</th>
                                <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">Video Pendek</th>
                                <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">Tanggal</th>
                                <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @foreach ($posts as $post)
                                <tr>
                                    <td class="px-4 py-3 text-sm text-gray-500">{{ $loop->iteration }}</td>
                                    <td class="px-4 py-3 text-sm text-gray-700">{{ $post->user->first_name }}</td>
                                    <td class="px-4 py-3">
                                        @if ($post->image)
                                            <img src="{{ asset('storage/' . $post->image) }}" 
                                                 alt="Gambar Postingan" 
                                                 class="w-12 h-12 rounded-full object-cover">
                                        @else
                                            <span class="text-sm text-gray-400">Tidak ada gambar</span>
                                        @endif
                                    </td>
                                    <td class="px-4 py-3 text-sm text-gray-500">{{ Str::limit($post->content, 30, '...') }}</td>
                                    <td class="px-4 py-3">
                                        @if ($post->video)
                                            <video width="80" class="rounded-lg shadow" controls>
                                                <source src="{{ $post->video }}" type="video/mp4">
                                            </video>
                                        @else
                                            <span class="text-sm text-gray-400">Tidak ada video</span>
                                        @endif
                                    </td>
                                    <td class="px-4 py-3">
                                        @if ($post->video_short)
                                            <video width="80" class="rounded-lg shadow" controls>
                                                <source src="{{ asset('storage/' . $post->video_short) }}" 
                                                        type="video/mp4">
                                            </video>
                                        @else
                                            <span class="text-sm text-gray-400">Tidak ada video pendek</span>
                                        @endif
                                    </td>
                                    <td class="px-4 py-3 text-sm text-gray-500">{{ $post->created_at->format('d-m-Y') }}</td>
                                    <td class="px-4 py-3 flex space-x-2">
                                        <a href="{{ route('posts.edit', $post->id) }}" 
                                           class="px-3 py-2 text-sm text-white bg-blue-500 rounded-lg hover:bg-blue-600 transition">
                                            <i class="ti ti-pencil"></i>
                                        </a>
                                        <form action="{{ route('posts.destroy', $post->id) }}" 
                                              method="POST" 
                                              onsubmit="return confirm('Yakin ingin menghapus postingan ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" 
                                                    class="px-3 py-2 text-sm text-white bg-red-500 rounded-lg hover:bg-red-600 transition">
                                                <i class="ti ti-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
