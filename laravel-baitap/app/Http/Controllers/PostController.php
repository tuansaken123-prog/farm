<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; // Import DB Facade để dùng Query Builder

class PostController extends Controller
{
    // Hiển thị form tạo bài viết
    public function create()
    {
        return view('create');
    }

    // Xử lý kiểm tra dữ liệu form
    public function store(Request $request)
    {
        // Kiểm tra nếu có bất kỳ ô nào bị trống
        if (empty($request->slug) || empty($request->title) || empty($request->content)) {
            return redirect()->back()
                ->withInput() // Giữ lại dữ liệu đã nhập
                ->with('error', 'Phải nhập đủ 3 giá trị'); // Gửi thông báo lỗi
        }

        // Nếu nhập đủ thì chuyển sang trang hiển thị kết quả
        return redirect()->route('posts.show')->with('data', $request->only(['slug', 'title', 'content']));
    }

    // Hiển thị chi tiết bài viết theo ID nhập trên URL dùng Query Builder
    // Cho phép $id = null để xử lý khi chuyển hướng từ form store()
    public function show($id = null)
    {
        // Nếu chuyển hướng từ form tạo bài viết (có dữ liệu trong session)
        if (session()->has('data')) {
            $data = session('data');
            return view('show', compact('data'));
        }

        // Dùng Query Builder tìm bài viết theo id từ URL
        $post = DB::table('posts')->where('id', $id)->first();

        // Kiểm tra nếu không có bài viết tương ứng trong Database
        if (!$post) {
            abort(404, 'Không tìm thấy bài viết');
        }

        // Trả về view post_detail và truyền dữ liệu bài viết
        return view('post_detail', compact('post'));
    }

    // Lấy danh sách toàn bộ bài viết truyền ra trang chủ
    public function index()
    {
        $posts = DB::table('posts')->get();
        return view('home', compact('posts'));
    }
}