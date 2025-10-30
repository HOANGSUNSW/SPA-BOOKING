<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        // Nếu chưa đăng nhập
        if (!auth()->check()) {
            return redirect()->route('login.form')
                ->with('error', 'Vui lòng đăng nhập để truy cập khu vực quản trị.');
        }

        // Nếu đăng nhập nhưng không phải admin
        if (auth()->user()->role !== 'admin') {
            return redirect()->route('login.form')
                ->with('error', 'Bạn không có quyền truy cập khu vực quản trị!');
        }

        // Nếu là admin → cho phép đi tiếp
        return $next($request);
    }
}
