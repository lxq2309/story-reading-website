<?php


use App\Enums\ArticleStatus;
use Illuminate\Support\Facades\Auth;
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

    function validateArticleStatus($status): bool
    {
        if (is_numeric($status))
        {
            $status = (int)$status;
        }
        else
        {
            return false;
        }
        return ArticleStatus::tryFrom($status) != null;
    }

    function isMyAccount($currentUser, $targetUser): bool
    {
        if (empty($currentUser) || empty($targetUser))
        {
            return false;
        }
        return $currentUser->id === $targetUser->id;
    }
}
