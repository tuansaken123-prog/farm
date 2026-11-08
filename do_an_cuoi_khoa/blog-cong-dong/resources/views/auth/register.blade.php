@extends('layouts.app')
@section('title', 'Đăng Ký')
@section('content')
<div class="container my-5" style="max-width: 450px;">
    <h3 class="mb-4 text-center">Đăng Ký Tài Khoản</h3>
    <form action="{{ route('register') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label class="form-label">Họ tên</label>
            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" required>
            @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" required>
            @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Mật khẩu</label>
            <div class="input-group">
                <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" id="password" required>
                <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                    <i class="fa-solid fa-eye" id="eyeIcon"></i>
                </button>
            </div>
            @error('password') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Xác nhận mật khẩu</label>
            <div class="input-group">
                <input type="password" name="password_confirmation" class="form-control" id="password_confirmation" required>
                <button class="btn btn-outline-secondary" type="button" id="togglePasswordConfirm">
                    <i class="fa-solid fa-eye" id="eyeIconConfirm"></i>
                </button>
            </div>
        </div>

        <button type="submit" class="btn btn-primary w-100">Đăng ký</button>
    </form>
</div>

<script>
    // Ẩn/hiện mật khẩu ô chính
    document.getElementById('togglePassword').addEventListener('click', function () {
        const passwordInput = document.getElementById('password');
        const eyeIcon = document.getElementById('eyeIcon');
        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            eyeIcon.classList.replace('fa-eye', 'fa-eye-slash');
        } else {
            passwordInput.type = 'password';
            eyeIcon.classList.replace('fa-eye-slash', 'fa-eye');
        }
    });

    // Ẩn/hiện mật khẩu ô xác nhận
    document.getElementById('togglePasswordConfirm').addEventListener('click', function () {
        const passwordInput = document.getElementById('password_confirmation');
        const eyeIcon = document.getElementById('eyeIconConfirm');
        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            eyeIcon.classList.replace('fa-eye', 'fa-eye-slash');
        } else {
            passwordInput.type = 'password';
            eyeIcon.classList.replace('fa-eye-slash', 'fa-eye');
        }
    });
</script>
@endsection