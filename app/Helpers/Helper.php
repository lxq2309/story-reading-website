<?php


use Illuminate\Support\Facades\Route;

if (!function_exists('set_active')) {
    function set_active($route): string
    {
        return Route::is($route) ? 'active' : '';
    }

    function is_route($route): string
    {
        return Route::is($route);
    }
}
