<?php
namespace App\Http\Controllers;

use App\Models\Report;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    // Menampilkan form laporan
    public function create($type, $id)
    {
        return view('Admin.reports.Form-laporan', compact('type', 'id'));
    }

    // Menyimpan laporan ke database
    public function store(Request $request)
    {
        $validated = $request->validate([
            'type' => 'required|in:user,post',
            'id' => 'required|integer',
            'category' => 'required|string',
            'description' => 'required|string|max:500',
        ]);

        $report = Report::create([
            'reporter_id' => \Illuminate\Support\Facades\Auth::user()->id,
            'reported_user_id' => $validated['type'] === 'user' ? $validated['id'] : null,
            'reported_post_id' => $validated['type'] === 'post' ? $validated['id'] : null,
            'category' => $validated['category'],
            'description' => $validated['description'],
        ]);

        return redirect()->back()->with('success', 'Laporan Anda telah dikirim.');
    }
}
