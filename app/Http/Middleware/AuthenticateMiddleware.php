<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class AuthenticateMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        Log::info('Checking authentication for: ' . $request->path() . ', Auth::id() = ' . Auth::id());
        if(Auth::id() == null) {
            Log::info('User not authenticated, redirecting.');
            return redirect()->route("auth.admin")->with('error', 'ban chua dang nhap');
        }
        Log::info('User is authenticated.');
        return $next($request);
    }
}
