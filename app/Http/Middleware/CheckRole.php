<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle($request, Closure $next, $roleId)
    {
        // Get JWT token from the request headers
        $token = JWTAuth::parseToken();

        // Check if token is valid and retrieve the user
        $user = $token->authenticate();

        // Check if user exists and has the required role
        if ($user && $user->role === (int)$roleId) {
            return $next($request);
        }

        // Unauthorized response
        return response()->json(['error' => 'Unauthorized'], 401);
    }
}
