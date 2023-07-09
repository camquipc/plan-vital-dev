<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ControlAccesoMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $blockAccess = true;

        if (auth()->user()->role === 'admin') $blockAccess = false;

        if ($blockAccess) {

            return back()->with('message', ['danger', 'No eres Admin no tienes privilegios para acceder']);
        }

        return $next($request);
    }
}
