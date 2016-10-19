<?php
 namespace App\Http\Middleware;

 use Illuminate\Support\Facades\Auth;
 use Closure;

 class AdminMiddleware{

  /**
   * Handle an incoming request.
   *
   * @param  \Illuminate\Http\Request $request
   * @param  \Closure                 $next
   *
   * @return mixed
   */
  public function handle ( $request, Closure $next ) {
//   dd(Auth::user()->role);
    if ( Auth::guest() || Auth::user()->role == 'teacher') {
     if ( $request->ajax() || $request->wantsJson() ) {
      return response( 'Unauthorized', 401 );
     } else {
      return redirect( '/' );
     }
    }

   return $next( $request );
  }
 }