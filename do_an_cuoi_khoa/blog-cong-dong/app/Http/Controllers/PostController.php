<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Carbon\Carbon;

class PostController extends Controller
{
    // Trang danh sách bài viết công khai
    public function index(Request $request)
    {
        // 1. Tự động quét và cập nhật các bài hẹn giờ đã đến/qua thời gian thành 'published' bằng PHP
        $scheduledPosts = Post::where('status', 'scheduled')->whereNotNull('published_at')->get();
        foreach ($scheduledPosts as $post) {
            if (Carbon::parse($post->published_at)->setTimezone('Asia/Ho_Chi_Minh')->lte(Carbon::now('Asia/Ho_Chi_Minh'))) {
                $post->status = 'published';
                $post->save();
            }
        }

        // 2. Truy vấn lấy các bài đã xuất bản hoặc bài hẹn giờ đã đến hạn
        $query = Post::with(['user', 'category', 'tags'])
            ->where(function ($q) {
                $q->where('status', 'published')
                  ->orWhere(function ($sub) {
                      $sub->where('status', 'scheduled')
                          ->where('published_at', '<=', Carbon::now('Asia/Ho_Chi_Minh'));
                  });
            });

        // Tìm kiếm theo từ khóa
        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        // Lọc theo danh mục
        if ($request->filled('category')) {
            $query->whereHas('category', function ($q) use ($request) {
                $q->where('slug', $request->category);
            });
        }

        // Lọc theo tag
        if ($request->filled('tag')) {
            $query->whereHas('tags', function ($q) use ($request) {
                $q->where('slug', $request->tag);
            });
        }

        // Sắp xếp bài mới nhất lên đầu tiên
        $posts = $query->orderBy('id', 'desc')->paginate(6);
        $categories = Category::all();
        $tags = Tag::all();

        return view('posts.index', compact('posts', 'categories', 'tags'));
    }

    // Danh sách bài viết cá nhân
    public function myPosts()
    {
        // Tự động quét và cập nhật các bài hẹn giờ đã đến/qua thời gian thành 'published' bằng PHP
        $scheduledPosts = Post::where('status', 'scheduled')->whereNotNull('published_at')->get();
        foreach ($scheduledPosts as $post) {
            if (Carbon::parse($post->published_at)->setTimezone('Asia/Ho_Chi_Minh')->lte(Carbon::now('Asia/Ho_Chi_Minh'))) {
                $post->status = 'published';
                $post->save();
            }
        }

        $posts = Post::where('user_id', auth()->id())->latest()->paginate(10);
        return view('posts.my_posts', compact('posts'));
    }

    // Trang tạo bài viết mới
    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all();
        return view('posts.create', compact('categories', 'tags'));
    }

    // Lưu bài viết
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'content' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'required|in:draft,published,scheduled',
            'published_at' => 'nullable|date',
            'tags' => 'nullable|array',
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('posts', 'public');
        }

        $validated['slug'] = Str::slug($validated['title']) . '-' . time();
        $validated['user_id'] = auth()->id();

        // Nếu bỏ trống thời gian xuất bản thì gán thời gian hiện tại
        if (empty($validated['published_at'])) {
            $validated['published_at'] = Carbon::now('Asia/Ho_Chi_Minh');
            if ($validated['status'] === 'scheduled') {
                $validated['status'] = 'published';
            }
        } else {
            // Nếu thời gian hẹn giờ đã đến hoặc qua, tự động chuyển thành published luôn
            if ($validated['status'] === 'scheduled' && Carbon::parse($validated['published_at'])->setTimezone('Asia/Ho_Chi_Minh')->lte(Carbon::now('Asia/Ho_Chi_Minh'))) {
                $validated['status'] = 'published';
            }
        }

        $post = Post::create($validated);

        if (!empty($validated['tags'])) {
            $post->tags()->sync($validated['tags']);
        }

        Log::info('Post created successfully', ['post_id' => $post->id, 'user_id' => auth()->id()]);

        return redirect()->route('posts.myPosts')->with('success', 'Đăng bài viết thành công!');
    }

    // Trang hiển thị form chỉnh sửa bài viết
    public function edit($id)
    {
        $post = Post::findOrFail($id);
        Gate::authorize('update', $post);

        $categories = Category::all();
        $tags = Tag::all();

        return view('posts.edit', compact('post', 'categories', 'tags'));
    }

    // Xử lý cập nhật bài viết
    public function update(Request $request, $id)
    {
        $post = Post::findOrFail($id);
        Gate::authorize('update', $post);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'content' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'required|in:draft,published,scheduled',
            'published_at' => 'nullable|date',
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('posts', 'public');
        }

        if (empty($validated['published_at'])) {
            $validated['published_at'] = Carbon::now('Asia/Ho_Chi_Minh');
            if ($validated['status'] === 'scheduled') {
                $validated['status'] = 'published';
            }
        } else {
            if ($validated['status'] === 'scheduled' && Carbon::parse($validated['published_at'])->setTimezone('Asia/Ho_Chi_Minh')->lte(Carbon::now('Asia/Ho_Chi_Minh'))) {
                $validated['status'] = 'published';
            }
        }

        $post->update($validated);
        Log::info('Cập nhật bài viết thành công', ['post_id' => $post->id]);

        return redirect()->route('posts.myPosts')->with('success', 'Cập nhật bài viết thành công!');
    }

    // Trang chi tiết bài viết
    public function show($slug)
    {
        $post = Post::with(['user', 'category', 'tags', 'comments.user'])
            ->where('slug', $slug)
            ->firstOrFail();

        return view('posts.show', compact('post'));
    }

    // Xóa bài viết (Đưa vào thùng rác - Soft Delete)
    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        Gate::authorize('delete', $post);
        $post->delete();

        Log::info('Bài viết được chuyển vào thùng rác', ['post_id' => $id]);

        return redirect()->back()->with('success', 'Đã chuyển bài viết vào thùng rác.');
    }

    // Xem danh sách bài viết trong thùng rác
    public function trash()
    {
        $posts = Post::onlyTrashed()->where('user_id', auth()->id())->get();
        return view('posts.trash', compact('posts'));
    }

    // Khôi phục bài viết từ thùng rác
    public function restore($id)
    {
        $post = Post::onlyTrashed()->findOrFail($id);
        Gate::authorize('restore', $post);
        $post->restore();

        return redirect()->route('posts.trash')->with('success', 'Đã khôi phục bài viết thành công!');
    }

    // Xóa bài viết vĩnh viễn
    public function forceDelete($id)
    {
        $post = Post::onlyTrashed()->findOrFail($id);
        Gate::authorize('forceDelete', $post);
        $post->forceDelete();

        return redirect()->route('posts.trash')->with('success', 'Đã xóa vĩnh viễn bài viết!');
    }
}