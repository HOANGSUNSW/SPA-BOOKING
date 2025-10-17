<?php

namespace App\Http\Middleware;

use Closure;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthJwtMiddleware
{
  public function handle($request, Closure $next)
  {
    $token = session('jwt_token');
    if (!$token) {
      return redirect()->route('login.form')->with('error', 'Vui lòng đăng nhập.');
    }

    try {
      $user = JWTAuth::setToken($token)->toUser();
    } catch (\Exception $e) {
      return redirect()->route('login.form')->with('error', 'Phiên đăng nhập đã hết hạn.');
    }

    if (!$user) {
      return redirect()->route('login.form')->with('error', 'Vui lòng đăng nhập.');
    }

    $request->attributes->set('auth_user', $user);

    return $next($request);
  }
}
