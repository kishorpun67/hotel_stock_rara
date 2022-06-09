<?php

namespace App\Http\Middleware\SuperAdmin;

use Closure;
use Auth;

class SuperAdmin
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
        if(!Auth::guard('superAdmin')->check()) {
            return redirect('/superAdmin' )->with('error_message', 'You are not allowed');
        }
        return $next($request);
    }
}
