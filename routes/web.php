<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WebAuthController;

// Dùng FQCN middleware để tránh lỗi alias không tồn tại
use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\StaffMiddleware;
use App\Http\Middleware\AuthJwtMiddleware;

// Trang chủ → chuyển đến login (có thể đổi nếu muốn)
Route::get('/', fn() => redirect()->route('login.form'))->name('home');

// Form login/register
Route::get('/login',    [WebAuthController::class, 'showLoginForm'])->name('login.form');
Route::get('/register', [WebAuthController::class, 'showRegisterForm'])->name('register.form');

// Xử lý login/register/logout
Route::post('/login',    [WebAuthController::class, 'login'])->name('login');
Route::post('/register', [WebAuthController::class, 'register'])->name('register');
Route::post('/logout',   [WebAuthController::class, 'logout'])->name('auth.logout');

// Khu Admin (chỉ Admin)
Route::middleware([AdminMiddleware::class])->group(function () {
    Route::get('/admin/dashboard', fn() => view('admin.dashboard'))->name('admin.dashboard');
});

// Khu Staff (chỉ Staff — nếu muốn admin vào luôn, sửa StaffMiddleware)
Route::middleware([StaffMiddleware::class])->group(function () {
    Route::get('/staff/dashboard', fn() => view('staff.dashboard'))->name('staff.dashboard');
});

// Khu User (chỉ cần đăng nhập)
Route::middleware([AuthJwtMiddleware::class])->group(function () {
    Route::get('/user/home', fn() => view('user.home'))->name('user.home');
});

// Route test (tuỳ chọn)
Route::get('/dashboard', fn() => view('dashboard'))->name('dashboard');
Route::get('/app',       fn() => view('layouts.app'))->name('app');
