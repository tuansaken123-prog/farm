<?php

use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

// Trang Home
Route::get('/', [PostController::class, 'index'])->name('home');

// Trang Archive (Lưu trữ bài viết)
Route::get('/archive', function () {
    $posts = \Illuminate\Support\Facades\DB::table('posts')->get();
    return view('archive', compact('posts'));
});

// Trang Category (Chuyên mục)
Route::get('/category', function () {
    $posts = \Illuminate\Support\Facades\DB::table('posts')->get();
    return view('category', compact('posts'));
});

// Trang Pages (Giới thiệu)
Route::get('/pages', function () {
    return view('pages');
});

// Trang Contact (Liên hệ)
Route::get('/contact', function () {
    return view('contact');
})->name('contact');

// Trang xem chi tiết bài viết
Route::get('/posts/{id}', [PostController::class, 'show']);

// Nhóm Route tạo bài viết
Route::middleware(['check.login', 'check.admin'])->group(function () {
    Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create');
    Route::post('/posts', [PostController::class, 'store'])->name('posts.store');
});