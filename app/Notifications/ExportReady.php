<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class ExportReady extends Notification
{
    use Queueable;

    public function __construct(protected string $filename)
    {
    }

    public function via(object $notifiable): array
    {
        return ['database'];
    }

    public function toArray(object $notifiable): array
    {
        return [
            'message' => 'PDF-каталог готов',
            'filename' => $this->filename,
            'url' => route('admin.exports.download', ['file' => $this->filename]),
        ];
    }
}
