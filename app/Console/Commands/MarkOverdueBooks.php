<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Book_issue;
use Carbon\Carbon;

class MarkOverdueBooks extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'books:mark-overdue';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Mark issued books as overdue if not returned after 15 days';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $today = Carbon::today();

        // Find all issued books where issued date + 15 days < today
        $overdueBooks = Book_issue::where('status', 'Issued')
            ->whereDate('issue_date', '<=', $today->subDays(15))
            ->get();

        foreach ($overdueBooks as $issue) {
            $issue->status = 'Overdue';
            $issue->save();
        }
        $this->info(count($overdueBooks) . ' books marked as overdue.');
    }
}
