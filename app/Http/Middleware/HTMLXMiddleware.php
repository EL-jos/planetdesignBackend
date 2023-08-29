<?php

namespace App\Http\Middleware;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\View;

class HTMLXMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response) $next
     */
    public function handle(Request $request, \Closure $next)
    {
        View::share('isHTMXRequest', $request->headers->has('hx-request'));
        View::share('isHTMXRequest', $request->headers->has('hx-boosted'));
        $request->attributes->set('htmx', $request->headers->has('hx-request'));
        $request->attributes->set('htmx-boosted', $request->headers->has('hx-boosted'));
        $request->attributes->set('htmx-trigger', !$request->headers->has('hx-boosted') && $request->headers->has('hx-request'));

        return $next($request);
    }
}
