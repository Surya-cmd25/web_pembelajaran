<?php

namespace App\Notifications;

use App\Models\Recording;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class RecordingSubmitted extends Notification
{
    public function __construct(public Recording $recording) {}

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Setoran hafalan baru dari '.$this->recording->user->name)
            ->greeting('Halo, '.$notifiable->name.'!')
            ->line($this->recording->user->name.' baru saja menyetor hafalan untuk kartu konsep "'.$this->recording->conceptCard->name.'".')
            ->action('Tinjau Rekaman', route('admin.hafalan.index'))
            ->line('Dengarkan rekamannya dan berikan umpan balik kepada siswa.');
    }
}
