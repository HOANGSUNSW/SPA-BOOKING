<?php
    
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\WebAuthController;
    use App\Http\Controllers\AdminController;
Route::get('/app', function() {
    // Nếu login → hiển thị dashboard admin
    if(auth()->check() && auth()->user()->role === 'admin') {
        return view('admin.dashboard');
    }
    // Nếu chưa login → chuyển sang login
    return redirect()->route('login.form');
})->name('app');

// Trang gốc '/' redirect sang /app
Route::get('/', fn() => redirect()->route('app'));

// ----------------------
// Auth: Login / Register / Logout
// ----------------------
Route::get('/login', [WebAuthController::class, 'showLoginForm'])->name('login.form');
Route::post('/login', [WebAuthController::class, 'login'])->name('login');

Route::get('/register', [WebAuthController::class, 'showRegisterForm'])->name('register.form');
Route::post('/register', [WebAuthController::class, 'register'])->name('register');

Route::post('/logout', [WebAuthController::class, 'logout'])->name('logout');


Route::get('/admin/dashboard', fn() => view('admin.dashboard'))
    ->middleware(['auth', 'admin'])
    ->name('admin.dashboard');

Route::get('/admin/dashboard', function () {
    return view('admin.dashboard');
})->name('admin.dashboard');
