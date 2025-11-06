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
        $today = Carbon::today();
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
       $today = Carbon::today();
       $tomorrow = $today->copy()->subDays(14);

        // Books that are still issued and due tomorrow or overdue
        $dueSoonBooks = Book_issue::with('user', 'book')
            ->whereIn('status', ['Issued', 'Overdue'])
            ->where(function($q) use ($tomorrow) {
                $q->orWhereDate('issue_date', '<=', $tomorrow);
            })
            ->get();

        foreach ($dueSoonBooks as $issue) {
            $user = $issue->user;
            $library = Library::first();

            $data = [
                'recipient_id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'subject' => 'Book Due Reminder from ' . ($library->library_name ?? 'Library'),
                'message' => "Reminder: The book '{$issue->book->title}({$issue->id})' is due/overdue. Please return it to avoid increasing fines. ",
                'type' => 'Book Return Reminder',
                'issue_date' => $issue->issue_date? $issue->issue_date->format('Y-m-d') : null,
            ];

            $user->notify(new BookNotification($data));
        }

        $this->info(count($dueSoonBooks) . ' reminder notifications sent successfully.');

         /** 3. IDENTIFY USERS WITH NO BOOK ISSUES IN THE PAST YEAR */
        $oneYearAgo = Carbon::now()->subYear();
        $users = User::where('role', 'user')->where('created_at', '<=', $oneYearAgo)->where('status', 'active')
            ->where(function($query) use ($oneYearAgo) {
                $query->whereDoesntHave('bookIssues')
                ->orWhereHas('bookIssues', function($q) use ($oneYearAgo) {
                    $q->orderBy('created_at', 'desc')
                    ->limit(1)
                    ->where('created_at', '<=', $oneYearAgo);
                });
            })->get();
        foreach ($users as $user) {
            $user->status = 'disabled';
            $user->save();
        }
        $this->info(count($users) . ' users disabled (Because no borrow activity in the last year).');
    }
}