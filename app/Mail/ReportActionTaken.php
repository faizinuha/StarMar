<?php
namespace App\Mail;

use App\Models\Report;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ReportActionTaken extends Mailable
{
    use Queueable, SerializesModels;

    public $category;
    public $report;
    public $user;

    public function __construct($category, Report $report, User $user)
    {
        $this->category = $category;
        $this->report = $report;
        $this->user = $user;
    }

    public function build()
    {
        return $this->subject('Tindakan terhadap Laporan Anda')
                    ->view('emails.report-action-taken');
    }
}
