<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

class ValidateToken
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        if ($request->is('api/*')) {
            try {
                // Try to parse the token from the request
                $user = JWTAuth::parseToken()->authenticate();

                // If authentication fails or token is invalid/expired, JWTAuth will throw an exception
                if (!$user) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Token not valid or expired. Please log in again.',
                    ], 401);
                }
            } catch (JWTException $e) {
                return response()->json([
                    'success' => false,
                    'message' => 'Token not provided or invalid. Please log in again.',
                ], 401);
            }
        }

        return $next($request);
    }
}
