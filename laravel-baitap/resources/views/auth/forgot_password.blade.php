@extends('layouts.app')

@section('content')
<div class="container my-5" style="max-width: 500px;">
    <h3 class="text-center mb-4">Quên Mật Khẩu</h3>

    @if (session('status'))
        <div class="alert alert-success">{{ session('status') }}</div>
    @endif

    <form action="{{ route('password.email') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label class="form-label">Nhập Email tài khoản:</label>
            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" required>
            @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary w-100">Gửi mail cấp lại mật khẩu</button>
    </form>
</div>
@endsection