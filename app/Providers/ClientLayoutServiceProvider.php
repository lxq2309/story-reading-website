<?php

namespace App\Providers;

use App\Models\Genre;
use App\Models\Menu;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ClientLayoutServiceProvider extends ServiceProvider
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
        View::composer('client.*', function ($view) {
            $links = Menu::all();
            $genres = Genre::all();
            $currentUser = Auth::user();
            $isUserLoggedIn = Auth::check();
            $view->with('links', $links)
                ->with('genres', $genres)
                ->with('currentUser', $currentUser)
                ->with('isUserLoggedIn', $isUserLoggedIn);
        });
    }
}
