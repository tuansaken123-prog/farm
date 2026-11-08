<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use SoftDeletes;

   protected $fillable = [
    'user_id',
    'title',
    'slug',
    'content',
    'file_path', // Bắt buộc phải có dòng này để Post::create() lưu được đường dẫn ảnh
    'deleted_at',
];

    // Khai báo quan hệ: 1 bài viết thuộc về (belongsTo) 1 User
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}