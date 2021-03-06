<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use App\User;

class AdminMiddleware
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
            if (Auth::user()->user_type == 'frontend-user') {
              return redirect()->route('/frontend');
            }else{
        $user = User::all()->count();

        if (!($user == 1)) {
            if (!Auth::user()->hasPermissionTo('Administer roles & permissions')) //If user does //not have this permission
        {
              //  return redirect('/frontend');
               return redirect('errors.404');
            }
        }
        return $next($request);
    }
    }

}