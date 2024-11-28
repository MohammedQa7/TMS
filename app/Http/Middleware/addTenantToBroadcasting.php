<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class addTenantToBroadcasting
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $tenant = tenant(); // Fetch the current tenant
        if ($tenant) {
            \Log::info('Tenant ID: ' . tenant('id')); // Log the tenant ID
            $request->headers->set('X-Tenant', $tenant->id); // Add tenant to headers
        }

        return $next($request);
    }
}