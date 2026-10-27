<?php

namespace App\Providers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        // Định nghĩa Gate kiểm tra quyền sở hữu bài viết
        Gate::define('manage-post', function (User $user, Post $post) {
            return $user->id === $post->user_id;
        });
    }
}