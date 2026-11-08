<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PostTest extends TestCase
{
    use RefreshDatabase;

    // 1. Khách xem trang chủ
    public function test_guest_can_view_post_list()
    {
        $response = $this->get('/');
        $response->assertStatus(200);
    }

    // 2. Khách bị chuyển hướng khi vào trang tạo bài
    public function test_guest_cannot_access_create_post_page()
    {
        $response = $this->get('/posts/create');
        $response->assertRedirect('/login');
    }

    // 3. Đăng nhập và tạo bài viết thành công
    public function test_user_can_create_post_successfully()
    {
        $user = User::factory()->create();
        $category = Category::create(['name' => 'Test Cat', 'slug' => 'test-cat']);

        $response = $this->actingAs($user)->post('/posts', [
            'title' => 'Bài viết Test Feature',
            'category_id' => $category->id,
            'content' => 'Nội dung bài viết test feature',
            'status' => 'published',
        ]);

        // Sửa lại thành '/my-posts' cho khớp với thực tế Controller
        $response->assertRedirect('/my-posts'); 
        
        $this->assertDatabaseHas('posts', ['title' => 'Bài viết Test Feature']);
    }
    // 4. Kiểm tra validate khi thiếu tiêu đề
    public function test_user_cannot_create_post_without_title()
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)->post('/posts', ['content' => 'Thiếu tiêu đề']);
        $response->assertSessionHasErrors(['title']);
    }

    // 5. Tác giả xóa bài viết
    public function test_author_can_delete_own_post()
    {
        $user = User::factory()->create();
        $category = Category::create(['name' => 'Test Cat 2', 'slug' => 'test-cat-2']);
        $post = Post::create([
            'user_id' => $user->id,
            'category_id' => $category->id,
            'title' => 'Bài viết để xóa',
            'slug' => 'bai-viet-de-xoa',
            'content' => 'Nội dung',
            'status' => 'published',
        ]);

        $response = $this->actingAs($user)->delete("/posts/{$post->id}");
        $this->assertSoftDeleted('posts', ['id' => $post->id]);
    }

    // 6. Người khác không được xóa bài tác giả
    public function test_user_cannot_delete_others_post()
    {
        $user1 = User::factory()->create();
        $user2 = User::factory()->create();
        $category = Category::create(['name' => 'Test Cat 3', 'slug' => 'test-cat-3']);
        $post = Post::create([
            'user_id' => $user1->id,
            'category_id' => $category->id,
            'title' => 'Bài viết tác giả 1',
            'slug' => 'bai-viet-tac-gia-1',
            'content' => 'Nội dung',
            'status' => 'published',
        ]);

        $response = $this->actingAs($user2)->delete("/posts/{$post->id}");
        $response->assertStatus(403);
    }

    // 7. Admin truy cập Dashboard
    public function test_admin_can_access_dashboard()
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $response = $this->actingAs($admin)->get('/admin');
        $response->assertStatus(200);
    }

    // 8. Member thường bị chặn vào Dashboard
    public function test_member_cannot_access_admin_dashboard()
    {
        $member = User::factory()->create(['role' => 'member']);
        $response = $this->actingAs($member)->get('/admin');
        $response->assertStatus(403);
    }
}