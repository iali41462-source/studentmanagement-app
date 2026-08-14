<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */

    public function handle(Request $request, Closure $next, string $role): Response
    {
       // Pehle check karo user login hai ya nahi
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        // User ka role check karo
        if (Auth::user()->role != $role) {
            abort(403, 'Access Denied');
        }
    return $next($request);
    }
}
