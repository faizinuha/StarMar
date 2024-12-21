<?php
namespace App\Notifications;

use App\Models\Report;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class NewReportNotification extends Notification
{
    private $report;

    public function __construct(Report $report)
    {
        $this->report = $report;
    }

    public function via($notifiable)
    {
        return ['database', 'mail']; // Bisa menggunakan database atau email
    }

    public function toDatabase($notifiable)
    {
        return [
            'report_id' => $this->report->id,
            'reporter_name' => $this->report->reporter->name,
            'message' => 'Laporan baru masuk!',
        ];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->line('Laporan baru masuk dari ' . $this->report->reporter->name)
            ->action('Lihat Laporan', url('/admin/reports'));
    }
}
