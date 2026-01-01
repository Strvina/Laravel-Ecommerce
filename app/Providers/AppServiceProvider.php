<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\View;
use App\Models\Kuce; // ✅ Import your model

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
        // Share featured dogs with all views
        View::composer('*', function ($view) {
            $view->with('featured', Kuce::featured()->take(3)->get());
        });

        // Use Bootstrap 5 for pagination globally
        Paginator::useBootstrapFive();
    }
}
