<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class AccountController extends Controller
{
    public function index()
    {
        // Ambil semua data user dari database
        $users = User::all();

        // Kirim data ke view
        return view('account-users.Database', compact('users'));
    }
}
