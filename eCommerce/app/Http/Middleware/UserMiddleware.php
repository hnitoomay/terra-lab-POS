<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class UserMiddleware
{

    public function handle(Request $request, Closure $next): Response
    {

        if(Auth::user()){
            if(Auth::user()->role == 'user'){

                if($request->route()->getName() == 'login'|| $request->route()->getName() == 'register'){
                    return back();
                }
                return $next($request);
            }
            return back();
        }else{
            //return $next($request);
            return back();
        }
    }
}
