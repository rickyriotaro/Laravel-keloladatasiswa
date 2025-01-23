<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckUserLevel
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$levels)
    {
        // Periksa apakah level pengguna termasuk dalam array level yang diizinkan
        if (!in_array(auth()->user()->level, $levels)) {
            abort(403, 'Unauthorized action.');
        }

        return $next($request);
    }
}
