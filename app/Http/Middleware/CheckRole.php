<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        $roles = array_map('intval', $roles);
        $currentUser = Auth::user();
        if (!Auth::check() || !$currentUser->hasAnyRole($roles)) {
            return redirect()->route('home.index');
        }
        return $next($request);
    }
}
