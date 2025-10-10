<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Users;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Facades\JWTAuth;

class WebAuthController extends Controller
{
    // Hiển thị form đăng nhập
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Hiển thị form đăng ký
    public function showRegisterForm()
    {
        return view('auth.register');
    }

    // Đăng ký người dùng mới (web)
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|unique:users,name',
            'email' => 'required|email|unique:users,email',
            'phone' => 'required|string',
            'address' => 'required|string',
            'password' => 'required|string|min:6',
        ]);

        $user = Users::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'password' => Hash::make($request->password),
            'role' => 'user',
        ]);

        // Tự động đăng nhập
        $token = JWTAuth::fromUser($user);
        session(['jwt_token' => $token, 'user_name' => $user->name]);

        return redirect()->route('home')->with('success', 'Đăng ký thành công!');
    }

    // Đăng nhập web
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (!$token = JWTAuth::attempt($credentials)) {
            return back()->with('error', 'Email hoặc mật khẩu không đúng.');
        }

        $user = auth()->user();
        session(['jwt_token' => $token, 'user_name' => $user->name]);

        return redirect()->route('dashboard')->with('success', 'Đăng nhập thành công!');
    }

    // Đăng xuất
    public function logout()
    {
        session()->forget(['jwt_token', 'user_name']);
        auth()->logout();
        return redirect()->route('login')->with('success', 'Đăng xuất thành công!');
    }
}
