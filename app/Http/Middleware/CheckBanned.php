<?php

namespace App\Http\Middleware;

use App\Models\BannedUser;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckBanned
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $currentUser = Auth::user();
        if ($currentUser->should_re_login)
        {
            $currentUser->setShouldReLogin(false);
            Auth::logout();
            session()->flush();
            return redirect()->route('login');
        }
        $isBanned = !empty($currentUser->banned);
        if (!is_route('users.handle_banned') && $isBanned) {
            return redirect()->route('users.handle_banned');
        }
        return $next($request);
    }
}
