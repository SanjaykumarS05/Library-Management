<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class BookNotification extends Notification
{
    use Queueable;

    protected $data;

    public function __construct(array $data)
    {
        $this->data = $data;
    }

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
    public function toMail($notifiable)
    {
        $type = trim($this->data['type']);
        $message = trim($this->data['message'] ?? '');
        $dueDate = $this->data['due_date'] ?? null; // use lowercase key

        $mail = (new MailMessage)
            ->subject($this->data['subject'] ?? 'Library Notification')
            ->greeting('Hello ' . ($this->data['name'] ?? 'User'))
            ->line("This is {$type}")
            ->line($message)
            ->line("Don't reply to this email. This is an automated message.");

        if ($dueDate) {
            $mail->line("Due Date: {$dueDate}");
        }

        return $mail->line('Thank you for using our system!');
        }


    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
