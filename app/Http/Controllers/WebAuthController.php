<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Users;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

class WebAuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function showRegisterForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|unique:users,name',
            'email'    => 'required|email|unique:users,email',
            'phone'    => 'required|string',
            'address'  => 'required|string',
            'password' => 'required|string|min:6',
        ]);

        $user = Users::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'phone'    => $request->phone,
            'address'  => $request->address,
            'password' => Hash::make($request->password),
            'role'     => 'user', // admin/staff tạo qua seeder/panel
        ]);

        $token = JWTAuth::fromUser($user);

        session([
            'jwt_token' => $token,
            'user_name' => $user->name,
            'user_role' => $user->role,
        ]);

        return $this->redirectByRole($user->role)
            ->with('success', 'Đăng ký & đăng nhập thành công!');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required|string|min:6',
        ]);

        $credentials = $request->only('email', 'password');

        try {
            if (!$token = JWTAuth::attempt($credentials)) {
                return back()->with('error', 'Email hoặc mật khẩu không đúng.');
            }

            $user = JWTAuth::user() ?: JWTAuth::setToken($token)->toUser();

            session([
                'jwt_token' => $token,
                'user_name' => $user->name,
                'user_role' => $user->role,
            ]);

            return $this->redirectByRole($user->role)
                ->with('success', 'Đăng nhập thành công!');
        } catch (JWTException $e) {
            return back()->with('error', 'Không thể tạo/đọc token. Vui lòng thử lại.');
        }
    }

    public function logout()
    {
        try {
            if ($token = session('jwt_token')) {
                JWTAuth::setToken($token)->invalidate();
            }
        } catch (\Exception $e) {
            // ignore
        }

        session()->forget(['jwt_token', 'user_name', 'user_role']);

        return redirect()->route('login.form')->with('success', 'Đăng xuất thành công!');
    }

    private function redirectByRole(string $role)
    {
        return match ($role) {
            'admin'  => redirect()->route('admin.dashboard'),
            'staff'  => redirect()->route('staff.dashboard'),
            default  => redirect()->route('user.home'),
        };
    }
}
