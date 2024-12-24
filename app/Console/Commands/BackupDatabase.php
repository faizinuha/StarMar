<?php
namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use ZipArchive;

class BackupDatabase extends Command
{
    // Menentukan nama command
    protected $signature = 'backup:database';
    // Deskripsi singkat command
    protected $description = 'Backup database dan buat file zip';

    // Menangani proses backup database
    public function handle()
    {
        // Menampilkan pesan informasi
        $this->info('Proses backup dimulai...');

        // Pastikan folder backups ada
        if (!File::exists(storage_path('app/backups'))) {
            File::makeDirectory(storage_path('app/backups'), 0777, true);
        }

        // Tentukan nama file backup dan lokasi file SQL
        $timestamp = now()->format('Y_m_d_His');
        $backupFile = storage_path("app/backups/backups_StarMar_{$timestamp}.sql");

        // Menentukan path untuk mysqldump (full path jika diperlukan)
        $mysqldumpPath = 'C:/laragon/bin/mysql/mysql-8.0.30-winx64/bin/mysqldump.exe'; // Contoh path untuk Windows
        // Anda juga bisa menggunakan path default jika menggunakan Linux/Mac
        // $mysqldumpPath = '/usr/bin/mysqldump';

        // Menjalankan mysqldump untuk mengekspor database ke file .sql
        $this->info('Mohon Tunggu sebentar database sedang Di Buat...');
        $command = "{$mysqldumpPath} -u root -p Instagram > $backupFile";
        exec($command);

        // Setelah file .sql dibuat, kita zip file tersebut
        $zipFile = storage_path("app/backups/backups_StarMar_{$timestamp}.zip");
        $zip = new ZipArchive;

        if ($zip->open($zipFile, ZipArchive::CREATE) === TRUE) {
            $zip->addFile($backupFile, "backups_StarMar_{$timestamp}.sql");
            $zip->close();

            // Menghapus file .sql setelah di-zip
            unlink(filename: $backupFile);

            $this->info("Backup Data2 Selesai : $zipFile");
        } else {
            $this->error('Gagal membuat file zip.');
        }
    }
}
