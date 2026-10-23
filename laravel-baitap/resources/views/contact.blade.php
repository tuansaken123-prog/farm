@extends('layouts.app')

@section('title', 'Contact Us - Learn2Earn')

@section('content')
<!-- Banner Contact chuẩn hình mẫu -->
<div class="bg-dark text-white text-center py-5 mb-5 rounded-3"
    style="background: linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.5)), url('https://picsum.photos/1200/350') center/cover;">
    <div class="container py-4">
        <h1 class="display-4 fw-bold">Contact Us</h1>
        <p class="lead">Home - Contact Us</p>
    </div>
</div>

<!-- Form Liên hệ -->
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card p-4 shadow-sm border-0">
            <h4 class="mb-4 text-primary fw-bold">Gửi tin nhắn cho chúng tôi</h4>
            <form>
                <div class="mb-3">
                    <label class="form-label font-weight-bold">Họ và tên</label>
                    <input type="text" class="form-control" placeholder="Nhập họ tên...">
                </div>
                <div class="mb-3">
                    <label class="form-label font-weight-bold">Email</label>
                    <input type="email" class="form-control" placeholder="Nhập email...">
                </div>
                <div class="mb-3">
                    <label class="form-label font-weight-bold">Lời nhắn</label>
                    <textarea class="form-control" rows="4" placeholder="Nhập nội dung..."></textarea>
                </div>
                <button type="button" class="btn btn-warning text-white fw-bold">Gửi tin nhắn</button>
            </form>
        </div>
    </div>
</div>
@endsection