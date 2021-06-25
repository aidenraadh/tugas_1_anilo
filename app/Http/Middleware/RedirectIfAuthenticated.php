<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Firebase\JWT\JWT;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  ...$guards
     * @return mixed
     */
    public function handle(Request $request, Closure $next, ...$guards)
    {
        if ($request->cookie('token')) {
            JWT::decode($request->cookie('token'), config('app.jwt_secret_key'),['HS256']);
            return redirect()->route('profile');
        }
        else{
            return $next($request);
        }
    }
}
