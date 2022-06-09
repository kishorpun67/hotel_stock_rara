<?php

namespace App\Http\Middleware\Admin;

use Closure;
use Auth;

class Admin
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
        if(!Auth::guard('admin')->check()) {
            return redirect('/admin' )->with('error_message', 'You are not allowed');
        }

        return $next($request);
    }
}
