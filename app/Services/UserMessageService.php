<?php

namespace App\Services;

use App\Models\User;
use App\Models\email_log;
use App\Notifications\userMailNotification;
use Illuminate\Support\Facades\Log;

class UserMessageService
{
    public function sendMessage(array $data)
    {
        try {
            $user = User::findOrFail($data['recipient_id']);
            $user->notify(new userMailNotification($data));

            email_log::create([
                'recipient_id' => $user->id,
                'sender_id' => auth()->id(),
                'email' => $user->email,
                'subject' => $data['subject'],
                'message' => $data['message'],
                'status' => 'Sent',
                'type' => $data['type'],
                'sent_at' => now(),
            ]);
        } catch (\Exception $e) {
            Log::error('Email failed: ' . $e->getMessage());
            email_log::create([
                'recipient_id' => $data['recipient_id'],
                'sender_id' => auth()->id(),
                'email' => $data['email'] ?? '',
                'subject' => $data['subject'] ?? '',
                'message' => $data['message'] ?? '',
                'status' => 'Failed',
                'type' => $data['type'],
                'sent_at' => now(),
            ]);
        }
    }
}
