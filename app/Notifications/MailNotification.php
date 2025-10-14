<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class MailNotification extends Notification implements ShouldQueue
{
    use Queueable;

    protected $data;

    public function __construct(array $data)
    {
        $this->data = $data;
    }

    public function via(object $notifiable): array
    {
        return ['mail', 'database'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject($this->data['subject'] ?? 'Library Notification')
            ->greeting('Hello ' . ($this->data['name'] ?? 'User'))
            ->line($this->data['message'])
            ->line('Thank you for using our system!');
    }

    public function toArray(object $notifiable): array
    {
        return [
            'name' => $this->data['name'] ?? null,
            'message' => $this->data['message'] ?? null,
            'phone' => $this->data['phone'] ?? null,
        ];
    }
}
