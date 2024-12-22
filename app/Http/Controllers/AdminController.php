<?php
namespace App\Http\Controllers;

use App\Models\Report;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ReportActionTaken;

class AdminController extends Controller
{
    public function reports()
    {
        // Mengambil laporan dengan status Pending dan Reviewed
        $pendingReports = Report::where('status', 'Pending')->get();
        $reviewedReports = Report::where('status', 'Reviewed')->get();
        
        return view('admin.reports.index', compact('pendingReports', 'reviewedReports'));
    }
    

    public function actionPage(Report $report)
    {
        return view('admin.reports.action', compact('report'));
    }

    public function takeAction(Request $request, Report $report)
    {
        $validated = $request->validate([
            'action' => 'required|string|in:delete_post,block_user,ignore',
            'category' => 'required|string|in:Spam,Inappropriate,Harassment',
            'reason' => 'required_if:action,delete_post|string|max:500',
        ]);

        $user = null;
        $post = null;
        
        // Menentukan penerima berdasarkan kategori laporan
        if ($validated['category'] === 'Spam' || $validated['category'] === 'Harassment') {
            $user = $report->reportedUser;  // Kirim email ke pengguna yang dilaporkan
        } elseif ($validated['category'] === 'Inappropriate') {
            $post = $report->reportedPost; // Kirim email ke pemilik postingan
            $user = $post->user; // Menentukan pengguna pemilik postingan
        }

        // Proses aksi yang dipilih oleh admin
        if ($validated['action'] === 'delete_post') {
            // Logika untuk menghapus postingan
            $post->delete();
        } elseif ($validated['action'] === 'block_user') {
            // Logika untuk memblokir user
            $user->update(['status' => 'blocked']);
        }

        // Update status laporan menjadi 'Reviewed'
        $report->status = 'Reviewed';
        $report->save();

        // Kirim email berdasarkan kategori dan aksi
        Mail::to($user->email)->send(new ReportActionTaken($validated['category'], $report, $user));

        return redirect()->route('admin.reports')->with('success', 'Tindakan telah dilakukan.');
    }
}
