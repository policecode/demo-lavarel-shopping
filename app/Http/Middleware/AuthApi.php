<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Laravel\Sanctum\PersonalAccessToken;

class AuthApi
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if ($request->header('authorization')) {
            $hashToken = $request->header('authorization');
            $hashToken = str_replace('Bearer', '', $hashToken);
            $hashToken = trim($hashToken);
            if (PersonalAccessToken::findToken($hashToken)) {
                return $next($request);
            } else {
                return response()->json(['status' => 'no_login']);
            }
        } else {
            return response()->json(['status' => 'no_login']);
        }
    }
}
