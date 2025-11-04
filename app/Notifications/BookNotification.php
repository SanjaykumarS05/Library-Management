<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Storage;
use App\Models\libray;
use App\Models\Book_issue;
use App\Models\User;
use App\Models\email_log;
use Illuminate\Contracts\Queue\ShouldQueue;
class BookNotification extends Notification implements ShouldQueue
{
    use Queueable;

    protected $data;

    public function __construct(array $data)
    {
        $this->data = $data;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        $type = $this->data['type'] ?? 'Book Notification';
        $message = $this->data['message'] ?? '';
        $dueDate = $this->data['due_date'] ?? null;
        $barcodePath = $this->data['barcode_path'] ?? null;
        $issueDate = $this->data['issue_date'] ?? null;  


        $mail = (new MailMessage)
            ->subject($this->data['subject'] ?? 'Library Notification')
            ->greeting('Hello ' . ($this->data['name'] ?? 'User'))
            ->line("This is {$type}.")
            ->line($message)
            ->line("Don't reply to this email. This is an automated message.");
        
        if ($issueDate) {
            $mail->line("Issued On: {$issueDate}");
        }

        if ($dueDate) {
            $mail->line("Due Date: {$dueDate}");
        }
        if (isset($this->data['id'])) {
            $mail->line("Book Issue ID: {$this->data['id']}");
        }
        

        if ($barcodePath && Storage::disk('public')->exists($barcodePath)) {
            $fullPath = Storage::disk('public')->path($barcodePath);
            $fileName = basename($barcodePath);
            $mail->attach($fullPath, ['as' => $fileName, 'mime' => 'image/png']);
            $mail->line('Book barcode image has been attached to this email.');
        }

        $mail->line('Thank you for using our system!')
             ->salutation('Regards, ' . ($this->data['library_name'] ?? 'Library Team'));


         try {
            Email_log::create([
                'recipient_id' => $this->data['recipient_id'] ?? null,
                'sender_id' => auth()->id() ?? null,
                'email' => $this->data['email'] ?? null,
                'subject' => $this->data['subject'] ?? 'Library Notification',
                'message' => $this->data['message'] ?? '',
                'status' => 'Sent',
                'type' => $this->data['type'] ?? null,
                'sent_at' => now(),
            ]);
        } catch (\Exception $e) {
            \Log::error('Failed to log email: ' . $e->getMessage());
        }

        return $mail;
    }

    public function toArray($notifiable)
    {
        return [];
    }
}
