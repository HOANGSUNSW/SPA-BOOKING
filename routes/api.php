<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
| Các route trong file này sẽ tự động có prefix /api
| Ví dụ: route('auth/login') => http://127.0.0.1:8000/api/auth/login
|--------------------------------------------------------------------------
*/

Route::get('/ping', fn() => response()->json(['message' => 'API is working!']));

// Không yêu cầu token cho login/register
Route::post('/auth/register', [AuthController::class, 'register']);
Route::post('/auth/login', [AuthController::class, 'login']);

// Nhóm route cần token JWT
Route::middleware('auth:api')->group(function () {
    Route::get('/me', [AuthController::class, 'me']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/refresh', [AuthController::class, 'refresh']);
});