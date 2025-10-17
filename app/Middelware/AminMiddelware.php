<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (!auth()->check()) {
            return redirect()->route('login.form')->with('error', 'Vui lòng đăng nhập.');
        }

        if (auth()->user()->role !== 'admin') {
            return redirect()->route('login.form')->with('error', 'Bạn không có quyền truy cập.');
        }

        return $next($request);
    }
}