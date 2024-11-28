@extends('layouts.app')
@section('content')
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Account Users</title>
        <script src="https://cdn.tailwindcss.com"></script>
    </head>

    <body class="bg-gray-100 text-gray-800">
        <div class="container mx-auto py-8">
            <h1 class="text-3xl font-bold text-center mb-6 text-blue-600">Account Users</h1>

            <!-- Filter Section -->
            @if (session('success'))
            <div class="bg-green-100 text-green-700 px-4 py-2 rounded-lg mb-4">
                {{ session('success') }}
            </div>
        @endif
        
        @if ($errors->any())
            <div class="bg-red-100 text-red-700 px-4 py-2 rounded-lg mb-4">
                {{ implode(', ', $errors->all()) }}
            </div>
        @endif
        
            <div class="flex justify-between items-center mb-6">
                <form action="{{ route('Account.index') }}" method="GET" class="flex items-center space-x-4">
                    <label for="filter" class="text-gray-700 font-semibold">Filter:</label>
                    <select name="filter" id="filter" class="px-4 py-2 border rounded-lg">
                        <option value="" {{ request('filter') == '' ? 'selected' : '' }}>All</option>
                        <option value="admin" {{ request('filter') == 'admin' ? 'selected' : '' }}>Admin</option>
                        <option value="user" {{ request('filter') == 'user' ? 'selected' : '' }}>User</option>
                    </select>
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition">
                        Apply
                    </button>
                </form>
                <a href="#" class="bg-green-500 text-white px-4 py-2 rounded-lg hover:bg-green-600 transition">
                    Add User
                </a>
            </div>

            <!-- Table Section -->
            <div class="overflow-x-auto">
                <table class="table-auto w-full bg-white shadow-md rounded-lg">
                    <thead>
                        <tr class="bg-blue-100">
                            <th class="px-6 py-3 text-left font-semibold text-gray-700">ID</th>
                            <th class="px-6 py-3 text-left font-semibold text-gray-700">Name</th>
                            <th class="px-6 py-3 text-left font-semibold text-gray-700">Bio</th>
                            <th class="px-6 py-3 text-left font-semibold text-gray-700">Role</th>
                            <th class="px-6 py-3 text-left font-semibold text-gray-700">Email</th>
                            <th class="px-6 py-3 text-left font-semibold text-gray-700">Created At</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @forelse ($users as $index => $p)
                            <tr class="hover:bg-blue-50">
                                <td class="px-6 py-3">{{ $index + 1 }}</td> <!-- Menggunakan indeks untuk ID -->
                                <td class="px-6 py-3">{{ $p->name }}</td>
                                <td class="px-6 py-3">{{ $p->bio ?? 'N/A' }}</td>
                                <td class="px-6 py-3">
                                    @if ($p->hasRole('admin'))
                                        <span class="bg-blue-500 text-white px-3 py-1 rounded-full text-sm">Admin</span>
                                    @elseif ($p->hasRole('user'))
                                        <span class="bg-green-500 text-white px-3 py-1 rounded-full text-sm">User</span>
                                    @else
                                        <span class="bg-gray-500 text-white px-3 py-1 rounded-full text-sm">Unknown</span>
                                    @endif
                                </td>
                                <td class="px-6 py-3">{{ $p->email }}</td>
                                <td class="px-6 py-3">{{ $p->created_at->format('d-m-Y H:i') }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center text-gray-500 py-4">No users found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </body>

    </html>
@endsection
