<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\library;
use App\Models\Bookrequest;

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
            $view->with('library',library::first());
            $view->with('hasPendingRequests', $pendingRequestCount);
        });
    }
}
