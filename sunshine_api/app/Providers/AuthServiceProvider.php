<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * Register any authentication / authorization services.
     */
    public function register(): void
    {
        // Register any authentication services or bindings here if necessary
    }

    /**
     * Bootstrap any authentication / authorization services.
     */
    public function boot(): void
    {
        // Register policies or configure authorization logic (leave empty if not needed)
    }
}