<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckApiKey
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $apiKey = $request->header('X-API-KEY') ?? $request->query('api_key');

        if (!$apiKey) {
            return response()->json(['message' => 'API Key check failed: Key not provided'], 401);
        }

        $user = \App\Models\User::where('api_key', $apiKey)->first();

        if (!$user) {
            return response()->json(['message' => 'API Key check failed: Invalid Key'], 401);
        }

        return $next($request);
    }
}
