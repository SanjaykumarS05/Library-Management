<?php

namespace App\Services;

use App\Models\User;
use App\Models\email_log;
use App\Notifications\MailNotification;
use Illuminate\Support\Facades\Log;

class MessageService
{
    public function sendMessage(array $data)
    {
        try {
            $user = User::findOrFail($data['recipient_id']);
            $user->notify(new MailNotification($data));
            email_log::create([
                'recipient_id' => $user->id,
                'email' => $user->email,
                'subject' => $data['subject'] ?? 'Library Notification',
                'message' => $data['message'],
                'status' => 'Sent',
                'type' => 'User Notification',
                'sent_at' => now(),
            ]);
        } catch (\Exception $e) {
            Log::error('Email failed: ' . $e->getMessage());
            email_log::create([
                'recipient_id' => $data['recipient_id'],
                'email' => $data['email'] ?? '',
                'subject' => $data['subject'] ?? 'Library Notification',
                'message' => $data['message'] ?? '',
                'status' => 'Failed',
                'type' => 'User Notification',
                'sent_at' => now(),
            ]);
        }
    }
}
