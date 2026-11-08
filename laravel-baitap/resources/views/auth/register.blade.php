@extends('layouts.app')
@section('title', 'Đăng Ký')
@section('content')
<div class="container my-5" style="max-width: 450px;">
    <h3 class="mb-4 text-center">Đăng Ký Tài Khoản</h3>
    <form action="{{ route('register') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label class="form-label">Họ và tên</label>
            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                value="{{ old('name') }}">
            @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>
        <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                value="{{ old('email') }}">
            @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>
        <div class="mb-3">
            <label class="form-label">Mật khẩu</label>
            <input type="password" name="password" class="form-control @error('password') is-invalid @enderror">
            @error('password') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>
        <div class="mb-3">
            <label class="form-label">Xác nhận mật khẩu</label>
            <input type="password" name="password_confirmation" class="form-control">
        </div>
        <button type="submit" class="btn btn-success w-100">Đăng ký ngay</button>
    </form>
</div>
@endsection