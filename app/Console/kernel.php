<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    protected $commands = [
        \App\Console\Commands\BackupDatabase::class,
        \App\Console\Commands\RestoreBackup::class,
        \App\Console\Commands\BotAutoPost::class,
    ];

    protected function schedule(Schedule $schedule)
    {
        // Menjadwalkan backup secara otomatis, misalnya setiap hari jam 2 pagi
        $schedule->command('backup:database')->dailyAt('02:00');
        $schedule->command('backup:RestoreBackup')->dailyAt('02:00');

        // hapus story ketika sudah 24 jam
        $schedule->command('stories:delete-expired')->hourly();

        // post semua users
        $schedule->command('bot:post-comment')->daily();
    }

    // protected function commands()
    // {
    //     $this->load(__DIR__.'/Commands');

    //     require base_path('routes/console.php');
    // }
}