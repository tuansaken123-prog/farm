<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{
    // Đăng ký
    public function showRegister()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'member',
        ]);

        Auth::login($user);
        Log::info('User Registered & Logged In', ['user_id' => $user->id, 'email' => $user->email]);

        return redirect()->route('posts.index')->with('success', 'Đăng ký tài khoản thành công!');
    }

    // Đăng nhập
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            Log::info('User Logged In', ['user_id' => Auth::id()]);
            return redirect()->intended('/')->with('success', 'Đăng nhập thành công!');
        }

        // Chỉ giữ lại email, giúp ô mật khẩu tự động xóa trắng khi đăng nhập sai
        return back()->withErrors([
            'email' => 'Thông tin đăng nhập không chính xác.'
        ])->withInput($request->only('email'));
    }

    // Đăng xuất
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/')->with('success', 'Đã đăng xuất tài khoản.');
    }
}