<?php

namespace App\Console\Commands;

use App\Models\Story;
use Illuminate\Console\Command;

class DeleteExpiredStories extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:delete-expired-stories';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'hapus story otomatis ketika sudah 24 jam';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $deletedCount = Story::where('expires_at', '<', now())->delete();

        $this->info("Deleted {$deletedCount} expired stories.");
    }
}