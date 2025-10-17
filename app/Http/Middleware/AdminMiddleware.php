<?php

namespace App\Http\Middleware;

use Closure;
use Tymon\JWTAuth\Facades\JWTAuth;

class AdminMiddleware
{
    public function handle($request, Closure $next)
    {
        // Token được lưu trong session khi login WebAuthController
        $token = session('jwt_token');
        if (!$token) {
            return redirect()->route('login.form')->with('error', 'Vui lòng đăng nhập.');
        }

        try {
            $user = JWTAuth::setToken($token)->toUser();
        } catch (\Exception $e) {
            return redirect()->route('login.form')->with('error', 'Phiên đăng nhập đã hết hạn.');
        }

        if (!$user || $user->role !== 'admin') {
            return redirect()->route('user.home')->with('error', 'Bạn không có quyền truy cập trang admin.');
        }

        // Optionally attach user
        $request->attributes->set('auth_user', $user);

        return $next($request);
    }
}
