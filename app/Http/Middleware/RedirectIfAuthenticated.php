<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check()) {
            $user = Auth::user();

            // Redirect based on user role
            if (strtolower($user->role) === 'admin') {
                return redirect()->route('admin.dashboard');
            } elseif (strtolower($user->role) === 'student') {
                return redirect()->route('mahasiswa.dashboard');
            }
        }

        return $next($request);
    }
}
