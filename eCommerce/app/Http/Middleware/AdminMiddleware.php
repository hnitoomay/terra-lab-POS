<?php

namespace App\Http\Middleware;

use Closure;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {

        if(Auth::user()){
            if(Auth::user()->role == 'admin' || Auth::user()->role == 'adminJr'){

                if($request->route()->getName() == 'login'|| $request->route()->getName() == 'register'){
                    return back();
                }
                return $next($request);
            }
            return back();
        }else{
            return back();
        }


        //this is another way to find the route
        // if(url()->current() == route('auth#login') || (url()->current() == route('auth#register'))){
        //     return back();
        // }

        //dd(Auth::user()->role); // Check the user's role
        //dd($request->path());

       // Ensure the user is authenticated
    // if (!Auth::check()) {
    //     return redirect()->route('login');
    // }
    // // Log the role and request path for debugging
    // logger('User Role: ' . Auth::user()->role);
    // logger('Request path: ' . $request->path());
    // logger('Request matches "user/*": ' . ($request->is('user/*') ? 'true' : 'false'));


    // if (in_array(Auth::user()->role, ['admin', 'adminJr']) && Str::startsWith($request->path(), 'user/')) {
    //     logger('Admin tried to access a user route: ' . $request->path());
    //     return back(); // Redirect back if admin tries to access user route
    // }


    // return $next($request);

    }
}
