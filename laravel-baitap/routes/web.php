<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;
use App\Notifications\VerifyEmail as VerifyEmailNotification;

// 1. Route thử nghiệm Gửi Email & Notification
Route::get('/mail', function () {
    Mail::to('tuan@example.com')->send(new \App\Mail\VerifyEmail('Phùng Minh Châu'));
    return 'Email sent';
});

Route::get('/notify', function () {
    Notification::route('mail', 'tuan@example.com')->notify(new VerifyEmailNotification('Phùng Minh Châu'));
    return 'Notification sent';
});

// 2. Trang danh sách bài viết công khai
Route::get('/', [PostController::class, 'index'])->name('posts.index');
Route::get('/posts', [PostController::class, 'index']);

// 3. Chức năng Đăng ký / Đăng nhập / Quên mật khẩu
Route::middleware('guest')->group(function () {
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);

    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);

    // Route Quên mật khẩu & Đặt lại mật khẩu mới
    Route::get('/forgot-password', [AuthController::class, 'showForgotPassword'])->name('password.request');
    Route::post('/forgot-password', [AuthController::class, 'sendResetLink'])->name('password.email');
    Route::get('/reset-password/{token}', [AuthController::class, 'showResetPassword'])->name('password.reset');
    Route::post('/reset-password', [AuthController::class, 'updatePassword'])->name('password.update');
});

// 4. Đăng xuất
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');

// 5. Quản lý bài viết (Khai báo posts/create TRƯỚC posts/{id})
Route::middleware('auth')->group(function () {
    Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create');
    Route::post('/posts', [PostController::class, 'store'])->name('posts.store');

    Route::get('/posts/{id}/edit', [PostController::class, 'edit'])->name('posts.edit');
    Route::put('/posts/{id}', [PostController::class, 'update'])->name('posts.update');
    Route::delete('/posts/{id}', [PostController::class, 'destroy'])->name('posts.destroy');
});

// ĐẶT TRANG CHI TIẾT Ở DƯỚI CÙNG
Route::get('/posts/{id}', [PostController::class, 'show'])->name('posts.show');