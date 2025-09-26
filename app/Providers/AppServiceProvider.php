<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Vite;
use Illuminate\Support\Facades\Blade;
use Inertia\Inertia;

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
        // Prefetch de Vite para mejorar el rendimiento
        Vite::prefetch(concurrency: 3);

        // Compartir datos globales con Inertia.js
        Inertia::share([
            'auth' => fn() => [
                'user' => auth()->check()
                    ? auth()->user()->load('role')  // Carga también el nombre del rol
                    : null,
            ],
        ]);
    }
}
