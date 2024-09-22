<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * Register any events for your application.
     */
    public function register(): void
    {
        // Register any event listeners or custom events here
    }

    /**
     * Bootstrap any events for your application.
     */
    public function boot(): void
    {
        // You can register event listeners here (leave empty if not needed)
    }
}