<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class IsAdmin
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
    if (Auth::user() && Auth::user()->role === 'admin') {
      return $next($request);
    }
    return response()->json(['message' => 'You are not an admin'], 401);
  }
}
