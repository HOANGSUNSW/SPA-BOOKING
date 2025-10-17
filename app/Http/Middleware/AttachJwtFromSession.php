<?php

namespace App\Http\Middleware;

use Closure;

class AttachJwtFromSession
{
  public function handle($request, Closure $next)
  {
    if ($token = session('jwt_token')) {
      $request->headers->set('Authorization', 'Bearer ' . $token);
    }
    return $next($request);
  }
}
