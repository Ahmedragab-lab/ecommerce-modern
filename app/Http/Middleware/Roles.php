<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Roles
{

    public function handle(Request $request, Closure $next)
    {
       if(auth()->check()){
            if(Auth::user()->roles()->first()->allowed_route != ''){
                return $next($request);
            }else{
                // session()->flush();
                return redirect('home')->with('error','You have not admin access');
            }
       }else{
         return redirect()->route('login');
       }
    }
}
