<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Auth;

class AuthApi
{

    public function handle(Request $request, Closure $next)
    {
        if (!Auth::check()){
            return response()->json(['message', 'Unauthorised!'], 401);
        }else{
            $role_id = auth()->payload()->get('role_id');
        }

        
        return $next($request);
        
    }
}
