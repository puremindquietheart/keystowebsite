<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Auth;
use Closure;

class RevalidateBackHistory
{
    public function handle($request, Closure $next)
    {

        if (!Auth::user() && $request->user()) {
            return $next($request); 
        }

        $response = $next($request);
        return $response->header('Cache-Control','nocache, no-store, max-age=0, must-revalidate')
        ->header('Pragma','no-cache')
        ->header('Expires','Fri, 01 Jan 1990 00:00:00 GMT');
        
    }
}
