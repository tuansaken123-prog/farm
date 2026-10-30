@extends('layouts.app')

@section('content')
<div class="container my-5" style="max-width: 500px;">
    <h3 class="text-center mb-4">Đặt Lai Mật Khẩu Mới</h3>

    <form action="{{ route('password.update') }}" method="POST">
        @csrf
        <input type="hidden" name="token" value="{{ $token }}">
        <input type="hidden" name="email" value="{{ $email }}">

        <div class="mb-3">
            <label class="form-label">Mật khẩu mới:</label>
            <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" required>
            @error('password')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Xác nhận mật khẩu mới:</label>
            <input type="password" name="password_confirmation" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-success w-100">Cập nhật mật khẩu</button>
    </form>
</div>
@endsection