<?php

namespace App\Providers;

use App\Models\Genre;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class RightSidebarServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        View::composer('client.partials.right-sidebar', function ($view) {
            $genres = Genre::all();
            $view->with('genres', $genres);
        });
    }
}
