<?php

namespace App\Http\Middleware;

use Closure;

use App\Models\User;

use Auth;

class ShareUser
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
        // Share the user if logged in
        $user = NULL;
        if ( Auth::check() )
            $user = Auth::user();

        \View::share('user', $user); 

        return $next($request);
    }
}
