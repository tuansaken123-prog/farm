<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AdminController extends Controller
{
    public function dashboard()
    {
        $totalUsers = User::count();
        $totalPosts = Post::count();
        $totalComments = Comment::count();

        // 5 bài nhiều bình luận nhất theo yêu cầu đề bài
        $topPosts = Post::withCount('comments')
            ->orderBy('comments_count', 'desc')
            ->take(5)
            ->get();

        // Danh sách tất cả bài viết để Admin quản lý / xóa vi phạm
        $posts = Post::with(['user', 'category'])->latest()->paginate(10);
        $categories = Category::withCount('posts')->get();

        return view('admin.dashboard', compact('totalUsers', 'totalPosts', 'totalComments', 'topPosts', 'posts', 'categories'));
    }

    public function storeCategory(Request $request)
    {
        $request->validate(['name' => 'required|string|unique:categories,name']);
        
        Category::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
        ]);

        return back()->with('success', 'Thêm danh mục thành công!');
    }

    public function destroyCategory($id)
    {
        Category::findOrFail($id)->delete();
        return back()->with('success', 'Đã xóa danh mục.');
    }
}