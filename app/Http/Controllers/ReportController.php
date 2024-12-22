<?php
namespace App\Http\Controllers;

use App\Models\Report;
use Illuminate\Http\Request;
use App\Mail\ReportSubmitted;
use Illuminate\Support\Facades\Mail;

class ReportController extends Controller
{
    public function create($type, $id)
    {
        return view('Admin.reports.Form-laporan', compact('type', 'id'));
    }

    public function store(Request $request)
    {
        // Pastikan pengguna sudah login
        if (!\Illuminate\Support\Facades\Auth::check()) {
            return redirect()->route('login')->with('error', 'Anda harus login untuk mengirimkan laporan.');
        }
    
        $validated = $request->validate([
            'type' => 'required|in:user,post',
            'id' => 'required|integer',
            'category' => 'required|string',
            'description' => 'required|string|max:500',
        ]);
    
        // Membuat token unik untuk laporan
        $token = bin2hex(random_bytes(16));
    
        // Menyimpan laporan ke database
        Report::create([
            'reporter_id' => \Illuminate\Support\Facades\Auth::user()->id, // Menyimpan ID pengguna yang login
            'reported_user_id' => $validated['type'] === 'user' ? $validated['id'] : null,
            'reported_post_id' => $validated['type'] === 'post' ? $validated['id'] : null,
            'category' => $validated['category'],
            'description' => $validated['description'],
        ]);
    
        // Mengirim email kepada pengguna yang melaporkan
        Mail::to(\Illuminate\Support\Facades\Auth::user()->email)->send(new ReportSubmitted($token));
    
        return redirect()->back()->with('success', 'Laporan Anda telah dikirim.');
    }
    
}
