<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule)
    {
            $schedule->command('books:mark-overdue')->dailyAt('15:38')->timezone('Asia/Kolkata')->appendOutputTo(storage_path('logs/mark_overdue_books.log'));
            // $schedule->command('books:send-reminders')->dailyAt('15:38')->timezone('Asia/Kolkata')->appendOutputTo(storage_path('logs/send_reminders.log'));
        }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');
        require base_path('routes/console.php');
    }
}
