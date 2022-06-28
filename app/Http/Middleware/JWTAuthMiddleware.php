<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;

class JWTAuthMiddleware
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
        $value = Cookie::get('jwt');
        if ($value) {
            $request->headers->set('Authorization', 'Bearer ' . $value);
            $user = JWTAuth::parseToken()->authenticate();
            if ($user->is_admin) {
                return $next($request);
            }
            return redirect('/')->with('failed', "You don't have permission to access this page");
        }
        return redirect('/login');
    }
}
