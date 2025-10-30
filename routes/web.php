<?php
    
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Kernel;
use App\Http\Controllers\WebAuthController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\WorkScheduleController;
// Trang /app → hiển thị dashboard admin (bỏ check middleware tạm thời)
Route::get('/app', function () {
    if (auth()->check()) {
        // Nếu đã login → chuyển theo role
        if (auth()->user()->role === 'admin') {
            return view('admin.dashboard');
        }
        // nếu muốn thêm role khác (nhân viên, khách hàng) thì thêm ở đây
    }
    // Nếu chưa login → chuyển sang trang login
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
//Admin
Route::get('/admin/dashboard', [WebAuthController::class, 'dashboard'])
    ->name('admin.dashboard');

//Staff
Route::resource('staff', EmployeeController::class);

Route::get('/admin/staff', [EmployeeController::class, 'index'])->name('admin.staff');
Route::resource('employees', EmployeeController::class);


//Customer
Route::resource('admin/customers', CustomerController::class);

Route::get('/admin/customers', [CustomerController::class, 'customers'])->name('admin.customers');
Route::post('/customers', [CustomerController::class, 'store'])->name('customers.store');
Route::put('/customers/{id}', [CustomerController::class, 'update'])->name('customers.update');
Route::delete('/customers/{id}', [CustomerController::class, 'destroy'])->name('customers.destroy');
//WorkSchedules
Route::get('admin/workschedules', [WorkScheduleController::class, 'index'])
    ->name('admin.workschedules');
Route::post('/workschedules', [WorkScheduleController::class, 'store'])
    ->name('workschedules.store');
Route::delete('/workschedules/{id}', [WorkScheduleController::class, 'destroy'])->name('workschedules.destroy');
Route::post('/workschedules/shifts', [WorkScheduleController::class, 'createShiftTemplate'])
    ->name('workschedules.createShift');
