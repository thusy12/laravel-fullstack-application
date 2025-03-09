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
    public function handlexxremovehere(Request $request, Closure $next): Response
    {
        if (auth()->check() && auth()->user()->role->name === $role) {
            return $next($request);
        }
        return redirect('/');
    }

    public function handle(Request $request, Closure $next, $role)
    {
        $user = Auth::user();

        // Ensure user exists and has a role before checking role name
        if (!$user || !$user->role || $user->role->name !== $role) {
            abort(403, 'Unauthorized access.');
        }

        return $next($request);
    }
}
