<?php
namespace App\Http\Controllers;

use App\Models\Report;

class AdminController extends Controller
{
    public function reports()
    {
        $reports = Report::where('status', 'Pending')->get();
        return view('admin.reports.index', compact('reports'));
    }

    public function takeAction(Report $report)
    {
        // Lakukan aksi berdasarkan laporan (misalnya hapus post, blokir user)
        $report->status = 'Reviewed';
        $report->save();

        // Tambahkan tindakan lebih lanjut, seperti memblokir user atau menghapus postingan
        return redirect()->route('admin.reports')->with('success', 'Tindakan telah dilakukan.');
    }
}
