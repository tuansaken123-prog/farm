@extends('layouts.app')
@section('title', 'Thùng Rác Bài Viết')
@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Thùng rác bài viết</h2>
    <a href="{{ route('posts.index') }}" class="btn btn-secondary btn-sm">Quay lại trang chủ</a>
</div>

@if($posts->count() > 0)
    <div class="table-responsive">
        <table class="table table-bordered align-middle">
            <thead class="table-dark">
                <tr>
                    <th>STT</th>
                    <th>Tiêu đề bài viết</th>
                    <th>Ngày xóa</th>
                    <th class="text-center">Hành động</th>
                </tr>
            </thead>
            <tbody>
                @foreach($posts as $index => $post)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td><strong>{{ $post->title }}</strong></td>
                        <td>{{ $post->deleted_at ? $post->deleted_at->format('d/m/Y H:i') : '' }}</td>
                        <td class="text-center">
                            <div class="d-flex justify-content-center gap-2">
                                <!-- Nút Khôi phục -->
                                <form action="{{ route('posts.restore', $post->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-success btn-sm">Khôi phục</button>
                                </form>

                                <!-- Nút Xóa vĩnh viễn -->
                                <form action="{{ route('posts.forceDelete', $post->id) }}" method="POST" onsubmit="return confirm('Bạn có chắc chắn muốn xóa vĩnh viễn bài viết này?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Xóa vĩnh viễn</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@else
    <div class="alert alert-info text-center py-4">
        Thùng rác trống. Không có bài viết nào bị xóa!
    </div>
@endif

@endsection