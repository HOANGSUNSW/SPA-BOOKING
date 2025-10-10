<?php
    
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\WebAuthController;
Route::get('/', fn() => redirect('/login'))->name('home');
Route::get('/', fn() => redirect('/register'))->name('home');
Route::get('/login', [WebAuthController::class, 'showLoginForm'])->name('login.form');
Route::get('/register', [WebAuthController::class, 'showRegisterForm'])->name('register.form');

Route::post('/login', [WebAuthController::class, 'login'])->name('login');
Route::post('/register', [WebAuthController::class, 'register'])->name('register');
Route::post('/logout', [WebAuthController::class, 'logout'])->name('logout');

// Các trang sau đăng nhập
Route::get('/admin/dashboard', fn() => view('admin.dashboard'))->name('admin.dashboard');
Route::get('/staff/dashboard', fn() => view('staff.dashboard'))->name('staff.dashboard');
Route::get('/user/home', fn() => view('user.home'))->name('user.home');




Route::get('/admin/dashboard', function() {
    return view('admin.dashboard');
})->middleware('admin');