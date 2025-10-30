<?php

namespace App\Http\Controllers;

use App\Models\Users;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

class AuthController extends Controller
{
    /**
     * Đăng ký tài khoản mới
     */
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:users,name',
            'email' => 'required|email|unique:users,email',
            'phone' => 'required|string|max:20',
            'address' => 'nullable|string|max:255',
            'password' => 'required|string|min:6',
            'role' => 'in:admin,staff,customer' // optional
        ]);

        try {
            $user = Users::create([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'address' => $request->address,
                'role' => $request->role ?? 'customer',
                'password' => Hash::make($request->password),
            ]);

            $token = JWTAuth::fromUser($user);
            $expiresIn = auth('api')->factory()->getTTL() * 60; // tính bằng giây

            return response()->json([
                'status' => 'success',
                'message' => 'User registered successfully!',
                'user' => $user,
                'authorisation' => [
                    'token' => $token,
                    'type' => 'bearer',
                    'expires_in' => $expiresIn
                ]
            ], 201);

        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Registration failed: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Đăng nhập và nhận JWT Token
     */
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:6',
        ]);

        $credentials = $request->only('email', 'password');

        try {
            if (! $token = JWTAuth::attempt($credentials)) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Invalid email or password',
                ], 401);
            }

            $user = auth()->user();
            $expiresIn = auth('api')->factory()->getTTL() * 60; // giây

            return response()->json([
                'status' => 'success',
                'message' => 'Login successful',
                'user' => $user,
                'authorisation' => [
                    'token' => $token,
                    'type' => 'bearer',
                    'expires_in' => $expiresIn
                ]
            ]);

        } catch (JWTException $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Could not create token: ' . $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Đăng xuất (vô hiệu hóa token)
     */
    public function logout()
    {
        try {
            JWTAuth::invalidate(JWTAuth::getToken());

            return response()->json([
                'status' => 'success',
                'message' => 'Successfully logged out',
            ]);
        } catch (JWTException $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to logout: token invalid or expired',
            ], 500);
        }
    }

    /**
     * Refresh token (tạo token mới khi gần hết hạn)
     */
    public function refresh()
    {
        try {
            $newToken = JWTAuth::refresh(JWTAuth::getToken());
            $expiresIn = auth('api')->factory()->getTTL() * 60;

            return response()->json([
                'status' => 'success',
                'message' => 'Token refreshed successfully',
                'authorisation' => [
                    'token' => $newToken,
                    'type' => 'bearer',
                    'expires_in' => $expiresIn
                ]
            ]);
        } catch (JWTException $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Token refresh failed: ' . $e->getMessage(),
            ], 401);
        }
    }

    /**
     * Lấy thông tin user đang đăng nhập
     */
    public function me()
    {
        try {
            $user = auth()->user();

            if (!$user) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'User not authenticated',
                ], 401);
            }

            return response()->json([
                'status' => 'success',
                'user' => $user,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to fetch user info: ' . $e->getMessage(),
            ], 500);
        }
    }
}
