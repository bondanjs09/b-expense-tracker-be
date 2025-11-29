<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;

class SuperadminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        try {
            $user = JWTAuth::parseToken()->authenticate();
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Token tidak valid atau tidak ditemukan'
            ], 401);
        }

        if ($user->role !== 'SUPERADMIN') {
            return response()->json([
                'status' => false,
                'message' => 'Akses ditolak. Khusus SUPERADMIN.'
            ], 403);
        }

        return $next($request);
    }
}
