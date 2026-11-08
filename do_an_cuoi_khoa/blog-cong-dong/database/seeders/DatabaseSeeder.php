<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Database\Seeder;
use Carbon\Carbon;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Đảm bảo luôn có ít nhất một User (Admin/Tác giả) để gán cho bài viết
        $user = User::first();
        if (!$user) {
            $user = User::create([
                'name' => 'Admin System',
                'email' => 'admin@gmail.com',
                'password' => bcrypt('12345678'),
                'role' => 'admin',
            ]);
        }
        $userId = $user->id;

        // 2. Tạo các Danh mục mẫu
        $cat1 = Category::firstOrCreate(['slug' => 'lap-trinh-web'], ['name' => 'Lập trình Web']);
        $cat2 = Category::firstOrCreate(['slug' => 'cong-nghe-24h'], ['name' => 'Công nghệ 24h']);
        $cat3 = Category::firstOrCreate(['slug' => 'khoa-hoc'], ['name' => 'Khóa Học']);

        // 3. Tạo các Thẻ (Tag) mẫu
        $tag1 = Tag::firstOrCreate(['slug' => 'laravel'], ['name' => 'Laravel']);
        $tag2 = Tag::firstOrCreate(['slug' => 'php'], ['name' => 'PHP']);
        $tag3 = Tag::firstOrCreate(['slug' => 'javascript'], ['name' => 'JavaScript']);

        // 4. Danh sách 20 bài viết mẫu có kèm hình ảnh minh họa từ Unsplash
        $samplePosts = [
            ['title' => 'Làm chủ Eloquent ORM trong Laravel 11', 'category' => $cat1->id, 'status' => 'published', 'tags' => [$tag1->id, $tag2->id], 'image' => 'https://images.unsplash.com/photo-1555066931-4365d14bab8c?w=600&auto=format&fit=crop&q=80'],
            ['title' => 'Xây dựng RESTful API với Laravel Sanctum', 'category' => $cat1->id, 'status' => 'published', 'tags' => [$tag1->id], 'image' => 'https://images.unsplash.com/photo-1516116216624-53e697fedbea?w=600&auto=format&fit=crop&q=80'],
            ['title' => 'Top 10 tính năng mới cực hay trong PHP 8.3', 'category' => $cat2->id, 'status' => 'published', 'tags' => [$tag2->id], 'image' => 'https://images.unsplash.com/photo-1599507593499-a3f7d7edc40b?w=600&auto=format&fit=crop&q=80'],
            ['title' => 'Sử dụng Blade Component tối ưu giao diện Laravel', 'category' => $cat1->id, 'status' => 'published', 'tags' => [$tag1->id], 'image' => 'https://images.unsplash.com/photo-1587620962725-abab7fe55159?w=600&auto=format&fit=crop&q=80'],
            ['title' => 'Xử lý bất đồng bộ trong JavaScript với Async/Await', 'category' => $cat1->id, 'status' => 'published', 'tags' => [$tag3->id], 'image' => 'https://images.unsplash.com/photo-1579468118864-1b9ea3c0db4a?w=600&auto=format&fit=crop&q=80'],
            ['title' => 'Bảo mật ứng dụng Web chống lại tấn công SQL Injection', 'category' => $cat2->id, 'status' => 'published', 'tags' => [$tag2->id], 'image' => 'https://images.unsplash.com/photo-1563986768609-322da13575f3?w=600&auto=format&fit=crop&q=80'],
            ['title' => 'Hướng dẫn cấu hình Docker cho dự án PHP/Laravel', 'category' => $cat2->id, 'status' => 'published', 'tags' => [$tag1->id, $tag2->id], 'image' => 'https://images.unsplash.com/photo-1605379399642-870262d3d051?w=600&auto=format&fit=crop&q=80'],
            ['title' => 'Tìm hiểu về Middleware và cách phân quyền trong Laravel', 'category' => $cat1->id, 'status' => 'published', 'tags' => [$tag1->id], 'image' => 'https://images.unsplash.com/photo-1526374965328-7f61d4dc18c5?w=600&auto=format&fit=crop&q=80'],
            ['title' => 'Tối ưu hóa tốc độ tải trang website với Redis Cache', 'category' => $cat2->id, 'status' => 'published', 'tags' => [$tag3->id], 'image' => 'https://images.unsplash.com/photo-1558494949-ef010cbdcc31?w=600&auto=format&fit=crop&q=80'],
            ['title' => 'Quản lý state hiệu quả trong ứng dụng Single Page App', 'category' => $cat1->id, 'status' => 'published', 'tags' => [$tag3->id], 'image' => 'https://images.unsplash.com/photo-1551288049-bebda4e38f71?w=600&auto=format&fit=crop&q=80'],
            ['title' => 'Kiểm thử tự động với PHPUnit và Pest trong Laravel', 'category' => $cat3->id, 'status' => 'published', 'tags' => [$tag1->id, $tag2->id], 'image' => 'https://images.unsplash.com/photo-1517694712202-14dd9538aa97?w=600&auto=format&fit=crop&q=80'],
            ['title' => 'Xây dựng hệ thống phân quyền RBAC từ con số không', 'category' => $cat1->id, 'status' => 'published', 'tags' => [$tag1->id], 'image' => 'https://images.unsplash.com/photo-1507238691740-187a5b1d37b8?w=600&auto=format&fit=crop&q=80'],
            ['title' => 'Xu hướng công nghệ Web phát triển mạnh mẽ năm 2026', 'category' => $cat2->id, 'status' => 'published', 'tags' => [$tag3->id], 'image' => 'https://images.unsplash.com/photo-1504384308090-c894fdcc538d?w=600&auto=format&fit=crop&q=80'],
            ['title' => 'Kỹ thuật tối ưu hóa câu lệnh truy vấn SQL cực đỉnh', 'category' => $cat3->id, 'status' => 'published', 'tags' => [$tag2->id], 'image' => 'https://images.unsplash.com/photo-1544383835-bda2bc66a55d?w=600&auto=format&fit=crop&q=80'],
            ['title' => 'Sử dụng Tailwind CSS kết hợp Bootstrap trong Laravel', 'category' => $cat1->id, 'status' => 'published', 'tags' => [$tag1->id], 'image' => 'https://images.unsplash.com/photo-1507238691740-187a5b1d37b8?w=600&auto=format&fit=crop&q=80'],
            ['title' => 'Quản lý mã nguồn chuyên nghiệp với Git Flow và GitHub', 'category' => $cat2->id, 'status' => 'published', 'tags' => [$tag2->id, $tag3->id], 'image' => 'https://images.unsplash.com/photo-1618401471353-b98aedd04e11?w=600&auto=format&fit=crop&q=80'],
            ['title' => 'Xây dựng tính năng đăng nhập mạng xã hội với Socialite', 'category' => $cat1->id, 'status' => 'published', 'tags' => [$tag1->id], 'image' => 'https://images.unsplash.com/photo-1563986768609-322da13575f3?w=600&auto=format&fit=crop&q=80'],
            ['title' => 'Bí quyết viết code sạch (Clean Code) cho lập trình viên', 'category' => $cat3->id, 'status' => 'published', 'tags' => [$tag2->id], 'image' => 'https://images.unsplash.com/photo-1461749280684-dccba630e2f6?w=600&auto=format&fit=crop&q=80'],
            ['title' => 'Bài viết đang lên lịch hẹn giờ xuất bản tự động', 'category' => $cat3->id, 'status' => 'scheduled', 'tags' => [$tag1->id], 'image' => 'https://images.unsplash.com/photo-1498050108023-c5249f4df085?w=600&auto=format&fit=crop&q=80'],
            ['title' => 'Bản nháp bài viết khóa học lập trình nâng cao', 'category' => $cat1->id, 'status' => 'draft', 'tags' => [$tag2->id], 'image' => 'https://images.unsplash.com/photo-1522071820081-009f0129c71c?w=600&auto=format&fit=crop&q=80'],
        ];

        // 5. Tiến hành lưu vào Database
        foreach ($samplePosts as $index => $data) {
            $publishedAt = match($data['status']) {
                'published' => Carbon::now('Asia/Ho_Chi_Minh')->subDays(20 - $index),
                'scheduled' => Carbon::now('Asia/Ho_Chi_Minh')->addDays(2),
                default => null,
            };

            $post = Post::create([
                'user_id' => $userId,
                'category_id' => $data['category'],
                'title' => $data['title'],
                'slug' => Str::slug($data['title']) . '-' . time() . '-' . $index,
                'content' => 'Nội dung chi tiết cho bài viết: ' . $data['title'] . '. Đây là dữ liệu mẫu phục vụ cho việc kiểm thử và báo cáo đồ án tốt nghiệp môn Phát triển ứng dụng Web.',
                'status' => $data['status'],
                'published_at' => $publishedAt,
                'image' => $data['image'], // Gán đường dẫn ảnh vào cột image của bảng posts
            ]);

            if (!empty($data['tags'])) {
                $post->tags()->sync($data['tags']);
            }
        }
    }
}