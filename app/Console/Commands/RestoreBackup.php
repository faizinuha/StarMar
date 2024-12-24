<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use ZipArchive;

class RestoreBackup extends Command
{
    protected $signature = 'backup:restore {backup_file}';
    protected $description = 'Restore database dan file dari backup zip';

    public function handle()
    {
        // Ambil argumen nama file backup
        $backupFile = $this->argument('backup_file');

        // Pastikan file backup memiliki ekstensi .zip jika tidak ada
        if (!str_ends_with($backupFile, '.zip')) {
            $backupFile .= '.zip';  // Menambahkan ekstensi .zip jika belum ada
        }

        $this->info("Mengembalikan data dari file backup: $backupFile");

        // Tentukan path untuk file zip yang diupload
        $zipPath = storage_path("app/backups/$backupFile");

        // Pastikan file zip ada
        if (!File::exists($zipPath)) {
            $this->error('File backup tidak ditemukan!');
            return;
        }

        // Ekstrak file zip
        $zip = new ZipArchive;
        if ($zip->open($zipPath) === TRUE) {
            // Ekstrak file zip ke folder backups
            $zip->extractTo(storage_path('app/backups/'));
            $zip->close();

            // Mengambil nama file SQL yang diekstrak
            $sqlFile = storage_path("app/backups/" . pathinfo($backupFile, PATHINFO_FILENAME) . ".sql");

            // Cek apakah file SQL ada dalam backup zip
            if (!File::exists($sqlFile)) {
                $this->error('Tidak ada file SQL dalam backup.');
                return;
            }

            // Jika file SQL ada, coba jalankan restore
            $this->info('Mengembalikan database...');

            // Tentukan path untuk mysql.exe di Laragon
            $mysqlPath = "\"C:/laragon/bin/mysql/mysql-8.0.30-winx64/bin/mysql.exe\""; // Ganti sesuai versi MySQL Anda

            // Tentukan perintah untuk menjalankan restore
            $command = "$mysqlPath -u root -p Instagram < $sqlFile";

            // Menjalankan perintah restore
            $result = exec($command, $output, $status);

            // Cek status eksekusi command
            if ($status === 0) {
                // Menghapus file SQL setelah di-restore
                File::delete($sqlFile);
                $this->info('Database berhasil dikembalikan!');
            } else {
                $this->error('Gagal mengembalikan database!');
                $this->line('Output: ' . implode("\n", $output)); // Menampilkan output dari perintah exec
                $this->line('Status: ' . $status); // Menampilkan status error
            }
        } else {
            $this->error('Gagal membuka file zip.');
        }
    }
}
