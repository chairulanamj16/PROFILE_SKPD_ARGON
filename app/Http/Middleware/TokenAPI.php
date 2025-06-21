<?php

namespace App\Http\Middleware;

use App\Models\V1\TokenApi as V1TokenApi;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TokenAPI
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // return $next($request);
        if (!$request->header('token-profil')) {
            return response()->json([
                "message" => "Token masih kosong",
                "status" => 413
            ]);
        }
        $token = V1TokenApi::where('token', $request->header('token-profil'))->first();
        if (!$token) {
            return response()->json([
                "message" => "Token tidak valid",
                "status" => 413
            ]);
        }
        return $next($request);
    }
}
