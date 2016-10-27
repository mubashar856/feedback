<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class TeacherMiddleware
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
        if(Auth::guest() || Auth::user()->role == 'admin'){
            if ( $request->ajax() || $request->wantsJson() ) {
                return response( 'Unauthorized', 401 );
            }else{
                return redirect('/');
            }
        }
        return $next($request);
    }
}
