<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AuthorizationLevel
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = auth()->guard('api')->user();

        if (!$user) {
            return response()->json([
                'success' => false,
                'status_code' => 401,
                'message' => 'You are not authenticated.'
            ], 401);
        }

        if ($user->level_id > 2 && $user->level_id !== 0) {
            return response()->json([
                'success' => false,
                'status_code' => 403,
                'message' => 'You are unauthorize user.'
            ], 403);
        }

        return $next($request);
    }
}
