<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use App\Models\MaintenanceLog;

class MaintenanceController extends Controller
{
    public function index()
    {
        // Cek status maintenance
        $isDown = app()->isDownForMaintenance();

        // Ambil riwayat perubahan status
        $logs = MaintenanceLog::orderBy('changed_at', 'desc')->get();

        return view('admin.maintenance', compact('isDown', 'logs'));
    }

    public function toggle(Request $request)
    {
        if ($request->has('enable')) {
            // Aktifkan Maintenance Mode
            Artisan::call('down', [
                '--render' => 'errors::maintain-admin',
                '--secret' => 'admin-access',
            ]);

            // Simpan ke log
            MaintenanceLog::create([
                'status' => 'Aktif',
                'changed_at' => now(),
            ]);
        } else {
            // Nonaktifkan Maintenance Mode
            Artisan::call('up');

            // Simpan ke log
            MaintenanceLog::create([
                'status' => 'Nonaktif',
                'changed_at' => now(),
            ]);
        }

        return redirect()->route('admin.maintenance')->with('success', 'Status Maintenance berhasil diperbarui!');
    }
}
