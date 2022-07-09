<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class UserAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next,$userrole)
    {
        if(auth()->user()->role === $userrole && $request->session()->has('user')){
        return $next($request);}

        return response()->json([auth()->user()->role]);
    }
}
