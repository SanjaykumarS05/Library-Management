<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\User;

class RegisterNotification extends Notification implements ShouldQueue
{
    use Queueable;

    protected $user;

    // Accept User model instead of array
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Welcome to Library Management System!')
            ->greeting('Hello ' . $this->user->name . '!')
            ->line('Welcome to our Library Management System. Your account has been successfully created.')
            ->line('You can now login and start exploring our library resources.')
            ->action('Login to Your Account', url('/'))
            ->line('Thank you for joining us!');
    }

    public function toArray(object $notifiable): array
    {
        return [
            'message' => 'Welcome to Library Management System!',
            'user_id' => $this->user->id,
            'user_name' => $this->user->name,
        ];
    }
}