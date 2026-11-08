<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Mail\WelcomeMail;
use App\Mail\ResetPasswordMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    // 1. ĐĂNG KÝ + GỬI MAIL CHÀO MỪNG + LOG THỜI GIAN
    public function showRegister() {
        return view('auth.register');
    }

    public function register(Request $request) {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
        ]);

        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
        ]);

        Auth::login($user);

        // Ghi Log thời gian đăng ký
        Log::info('User Registered', [
            'user_id' => $user->id,
            'email'   => $user->email,
            'time'    => now()->toDateTimeString()
        ]);

        // Gửi Mail chào mừng qua Mailtrap
        Mail::to($user->email)->send(new WelcomeMail($user));

        return redirect()->route('posts.index')->with('success', 'Đăng ký tài khoản thành công! Mail chào mừng đã được gửi.');
    }

    // 2. ĐĂNG NHẬP + LOG THỜI GIAN ĐĂNG NHẬP
    public function showLogin() {
        return view('auth.login');
    }

    public function login(Request $request) {
        $credentials = $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            // Ghi Log thời gian đăng nhập
            Log::info('User Logged In', [
                'user_id' => Auth::id(),
                'email'   => Auth::user()->email,
                'time'    => now()->toDateTimeString()
            ]);

            return redirect()->route('posts.index')->with('success', 'Đăng nhập thành công!');
        }

        return back()->withErrors(['email' => 'Thông tin đăng nhập không chính xác.'])->onlyInput('email');
    }

    public function logout(Request $request) {
        Log::info('User Logged Out', ['user_id' => Auth::id(), 'time' => now()->toDateTimeString()]);

        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('success', 'Đã đăng xuất!');
    }

    // 3. TÍNH NĂNG QUÊN MẬT KHẨU & ĐỔI MẬT KHẨU
    public function showForgotPassword() {
        return view('auth.forgot_password');
    }

    public function sendResetLink(Request $request) {
        $request->validate(['email' => 'required|email|exists:users,email'], [
            'email.exists' => 'Email này chưa được đăng ký trong hệ thống.'
        ]);

        $token = Str::random(64);

        // Lưu Token vào bảng password_reset_tokens
        DB::table('password_reset_tokens')->updateOrInsert(
            ['email' => $request->email],
            ['token' => $token, 'created_at' => now()]
        );

        // Gửi email reset password
        Mail::to($request->email)->send(new ResetPasswordMail($token, $request->email));

        return back()->with('status', 'Chúng tôi đã gửi link đặt lại mật khẩu vào email của bạn!');
    }

    public function showResetPassword(Request $request) {
        return view('auth.reset_password', [
            'token' => $request->token,
            'email' => $request->email
        ]);
    }

    public function updatePassword(Request $request) {
        $request->validate([
            'token'    => 'required',
            'email'    => 'required|email|exists:users,email',
            'password' => 'required|min:6|confirmed',
        ]);

        $resetRecord = DB::table('password_reset_tokens')
            ->where('email', $request->email)
            ->where('token', $request->token)
            ->first();

        if (!$resetRecord) {
            return back()->withErrors(['email' => 'Mã xác thực không hợp lệ hoặc đã hết hạn.']);
        }

        // Cập nhật mật khẩu mới
        $user = User::where('email', $request->email)->first();
        $user->password = Hash::make($request->password);
        $user->save();

        // Xóa token sau khi dùng
        DB::table('password_reset_tokens')->where('email', $request->email)->delete();

        // Ghi Log thời gian đổi mật khẩu
        Log::info('User Changed Password', [
            'user_id' => $user->id,
            'email'   => $user->email,
            'time'    => now()->toDateTimeString()
        ]);

        return redirect()->route('login')->with('success', 'Mật khẩu đã được cập nhật thành công! Vui lòng đăng nhập lại.');
    }
}