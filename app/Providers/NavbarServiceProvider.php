<?php

namespace App\Providers;

use App\Models\Genre;
use App\Models\Menu;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class NavbarServiceProvider extends ServiceProvider
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
        View::composer('layout.client', function ($view) {
            $links = Menu::all();
            $genres = Genre::all();
            $view->with('links', $links)->with('genres', $genres);
        });
    }
}
