<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Log;

class OtpNotification extends Notification implements ShouldQueue
{
    use Queueable;

    protected $otp;

    public function __construct($otp)
    {
        $this->otp = $otp;
    }

    public function via(object $notifiable): array
    {
        // For debugging, you can temporarily remove 'database'
        return ['mail','database']; // Removed 'database' for now
    }

    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Your Library Registration OTP Code')
            ->greeting('Hello ' . ($notifiable->name ?? 'User') . '!')
            ->line('Your OTP code for completing registration is:')
            ->line('**' . $this->otp . '**')
            ->line('This code will expire in 10 minutes. Do not share it with anyone.')
            ->action('Verify OTP', url('/'))
            ->line('If you did not request this OTP, please ignore this email.');
    }

    public function toArray(object $notifiable): array
    {
        return [
            'otp' => $this->otp,
            'message' => 'Your OTP code for completing registration is ' . $this->otp . '.',
        ];
    }
}