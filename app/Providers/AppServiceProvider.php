<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\library;
use App\Models\Bookrequest;
use App\Models\email_log;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        view()->composer('*', function ($view) {
            $pendingRequestCount = Bookrequest::where('status', 'pending')->count();
             $hasReceivedNotifications = email_log::where('recipient_id', auth()->id())
                    ->where('read', 0)
                    ->count();
            $view->with('library',library::first());
            $view->with('hasPendingRequests', $pendingRequestCount);
            $view->with('hasReceivedNotifications', $hasReceivedNotifications);
        });
    }
}
