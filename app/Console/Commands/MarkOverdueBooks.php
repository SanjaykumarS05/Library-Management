<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Book_issue;
use App\Models\User;
use App\Models\Library;
use App\Notifications\BookNotification;
use Carbon\Carbon;

class MarkOverdueBooks extends Command
{
    protected $signature = 'books:mark-overdue';
    protected $description = 'Mark overdue books and send due reminders';

    public function handle()
    {
        $today = Carbon::today();

        /** 1. MARK OVERDUE (issue_date < today - 15 days) */
        $overdueDate = $today->copy()->subDays(15);

        $overdueBooks = Book_issue::where('status', 'Issued')
            ->whereDate('issue_date', '<', $overdueDate)
            ->get();

        foreach ($overdueBooks as $issue) {
            $issue->status = 'Overdue';
            $issue->save();
        }

        $this->info(count($overdueBooks) . ' books marked as overdue.');


        /** 2. SEND REMINDER FOR BOOKS DUE TOMORROW (issue_date = today - 14 days) */
       $today = now();
       $tomorrow = $today->copy()->addDay();

        // Books that are still issued and due tomorrow or overdue
        $dueSoonBooks = Book_issue::with('user', 'book')
            ->where('status', 'Issued')
            ->where(function($q) use ($tomorrow) {
                $q->whereDate('issue_date', $tomorrow->copy()->subDays(14));
                $q->orWhereDate('issue_date', '<=', $tomorrow->copy()->subDays(14));
            })
            ->get();

        foreach ($dueSoonBooks as $issue) {
            $user = $issue->user;
            $library = Library::first();

            $data = [
                'name' => $user->name,
                'subject' => 'Book Due Reminder from ' . ($library->library_name ?? 'Library'),
                'message' => "Reminder: The book '{$issue->book->title}' is due/overdue. Please return it to avoid increasing fines.",
                'type' => 'Book Return Reminder',
            ];

            $user->notify(new BookNotification($data));
        }

        $this->info(count($dueSoonBooks) . ' reminder notifications sent successfully.');
        }
}