<?php

namespace App\Http\Middleware;

use Closure;
use Session;

class IsVerified
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
         if(auth()->user()->user_type == 'frontend-user'){

         return redirect('redirectme')->with('dont', 'You dont have Admin Rights.');
          }else{

          if(!auth()->user()->verified || auth()->user()->is_delete == 1){
           
            Session::flush();
        return redirect('login')->with('status', 'Please verify your email before login.');
        }

        return $next($request);

       }
     }
}