<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class CommentController extends Controller
{
    // Lưu bình luận
    public function store(Request $request, $postId)
    {
        $request->validate([
            'content' => 'required|string|max:1000',
        ]);

        Comment::create([
            'user_id' => auth()->id(),
            'post_id' => $postId,
            'content' => $request->content,
        ]);

        return redirect()->back()->with('success', 'Đăng bình luận thành công!');
    }

    // Xóa bình luận
    public function destroy($id)
    {
        $comment = Comment::findOrFail($id);
        $post = $comment->post;

        // Kiểm tra quyền: Là chủ bình luận, hoặc là Admin, hoặc là chủ bài viết
        if (auth()->id() === $comment->user_id || auth()->user()->role === 'admin' || auth()->id() === $post->user_id) {
            $comment->delete();
            return redirect()->back()->with('success', 'Đã xóa bình luận thành công.');
        }

        abort(403, 'Bạn không có quyền thực hiện hành động này.');
    }
}