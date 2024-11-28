<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class AccountController extends Controller
{
    public function index(Request $request)
    {
        // Ambil filter dari request (admin/user/all)
        $filter = $request->get('filter');

        // Query awal untuk User
        $usersQuery = User::query();

        // Filter berdasarkan role
        if ($filter === 'admin') {
            $usersQuery->whereHas('roles', function ($query) {
                $query->where('name', 'admin');
            });
        } elseif ($filter === 'user') {
            $usersQuery->whereHas('roles', function ($query) {
                $query->where('name', 'user');
            });
        }

        // Eksekusi query untuk mendapatkan data user
        $users = $usersQuery->get();

        // Kirim data ke view
        return view('account-users.Database', compact('users'));
    }
    
}
