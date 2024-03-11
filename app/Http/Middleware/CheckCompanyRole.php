<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckCompanyRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next)
    {
        if ($request->user() && $request->user()->rol->id !== 3) {
            return response()->json(['message' => 'Acceso no autorizado'], 403);
        }

        return $next($request);
    }
}
