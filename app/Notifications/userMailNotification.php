<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class userMailNotification extends Notification implements ShouldQueue
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
            ->subject($this->data['subject'] ?? 'User Notification')
            ->greeting('Hello ' . ($this->data['name'] ?? 'User'))
            ->line("This is {$this->data['type']}")
            ->line($this->data['message'])
            ->line('Thank you for using our system!');
    }

    public function toArray(object $notifiable): array
    {
        return [
            'recipient_id' => $this->data['recipient_id'] ?? null,
            'message'      => $this->data['message'] ?? null,
            'type'         => $this->data['type'] ?? null,
            'subject'      => $this->data['subject'] ?? null,
        ];
    }
}
