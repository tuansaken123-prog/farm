<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Log; // 1. Import Facade Log
use Illuminate\Support\Str;

class PostController extends Controller
{
    // 1. Danh sách bài viết
    public function index()
    {
        $posts = Post::withTrashed()->with('user')->latest()->get();
        return view('post_index', compact('posts'));
    }

    // 2. Trang chi tiết bài viết
    public function show($id)
    {
        $post = Post::withTrashed()->with('user')->findOrFail($id);
        return view('post_detail', compact('post'));
    }

    // 3. Hiển thị form tạo bài viết mới
    public function create()
    {
        return view('post_create');
    }

    // 4. Lưu bài viết mới
    public function store(Request $request)
    {
        $request->validate([
            'title'   => 'required|max:50',
            'content' => 'required',
            'image'   => 'nullable|image|mimes:jpeg,jpg,png,webp|max:2048',
        ], [
            'title.required' => 'Vui lòng nhập tiêu đề bài viết.',
            'title.max'      => 'Tiêu đề không được vượt quá 50 ký tự.',
            'image.image'    => 'Tập tải lên phải là hình ảnh.',
            'image.mimes'    => 'Ảnh chỉ chấp nhận định dạng: jpg, jpeg, png, webp.',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('uploads', 'public');
        }

        $post = Post::create([
            'user_id'   => Auth::id(), // Tự động lấy ID người dùng đang đăng nhập
            'title'     => $request->title,
            'slug'      => Str::slug($request->title),
            'content'   => $request->content,
            'file_path' => $imagePath,
        ]);

        // Ghi Log khi tạo bài viết thành công
        Log::info('Post created successfully', [
            'user_id' => Auth::id(),
            'post_id' => $post->id,
            'title'   => $post->title
        ]);

        return redirect()->route('posts.index')->with('success', 'Thêm bài viết thành công!');
    }

    // 5. Form chỉnh sửa bài viết (có kiểm tra Gate)
    public function edit($id)
    {
        $post = Post::findOrFail($id);

        if (Gate::denies('manage-post', $post)) {
            Log::warning('Unauthorized access attempt to edit post', [
                'user_id' => Auth::id(),
                'post_id' => $id
            ]);
            abort(403, 'Bạn không có quyền chỉnh sửa bài viết này!');
        }

        return view('post_edit', compact('post'));
    }

    // 6. Cập nhật bài viết
    public function update(Request $request, $id)
    {
        $post = Post::findOrFail($id);

        if (Gate::denies('manage-post', $post)) {
            Log::warning('Unauthorized access attempt to update post', [
                'user_id' => Auth::id(),
                'post_id' => $id
            ]);
            abort(403, 'Bạn không có quyền cập nhật bài viết này!');
        }

        $request->validate([
            'title'   => 'required|max:50',
            'content' => 'required',
            'image'   => 'nullable|image|mimes:jpeg,jpg,png,webp|max:2048',
        ], [
            'title.required' => 'Vui lòng nhập tiêu đề bài viết.',
            'title.max'      => 'Tiêu đề không được vượt quá 50 ký tự.',
            'image.image'    => 'Tập tải lên phải là hình ảnh.',
            'image.mimes'    => 'Ảnh chỉ chấp nhận định dạng: jpg, jpeg, png, webp.',
        ]);

        if ($request->hasFile('image')) {
            $post->file_path = $request->file('image')->store('uploads', 'public');
        }

        $post->title   = $request->title;
        $post->slug    = Str::slug($request->title);
        $post->content = $request->content;
        $post->save();

        // Ghi Log khi cập nhật thành công
        Log::info('Post updated successfully', [
            'user_id' => Auth::id(),
            'post_id' => $post->id
        ]);

        return redirect()->route('posts.index')->with('success', 'Cập nhật bài viết thành công!');
    }

    // 7. Xóa bài viết
    public function destroy(Request $request, $id)
    {
        $post = Post::withTrashed()->findOrFail($id);

        if (Gate::denies('manage-post', $post)) {
            Log::warning('Unauthorized access attempt to delete post', [
                'user_id' => Auth::id(),
                'post_id' => $id
            ]);

            if ($request->ajax()) {
                return response()->json(['error' => 'Bạn không có quyền xóa bài viết này!'], 403);
            }
            abort(403, 'Bạn không có quyền xóa bài viết này!');
        }

        if ($post->trashed()) {
            $post->forceDelete();
            $message = 'Đã xóa vĩnh viễn bài viết khỏi cơ sở dữ liệu!';
            Log::warning('Post permanently deleted', ['user_id' => Auth::id(), 'post_id' => $id]);
        } else {
            $post->delete();
            $message = 'Đã xóa mềm bài viết!';
            Log::info('Post soft deleted', ['user_id' => Auth::id(), 'post_id' => $id]);
        }

        if ($request->ajax()) {
            return response()->json(['success' => true, 'message' => $message]);
        }

        return redirect()->route('posts.index')->with('success', $message);
    }
}