<?php

namespace App\Console\Commands;

use App\Models\Post;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class PublishScheduledPosts extends Command
{
    protected $signature = 'posts:publish-scheduled';
    protected $description = 'Tự động đăng các bài viết hẹn giờ đã đến hạn';

    public function handle(): int
    {
        $count = Post::where('status', 'scheduled')
            ->where('published_at', '<=', now())
            ->update(['status' => 'published']);

        if ($count > 0) {
            Log::info("Task Scheduler: Đã tự động xuất bản {$count} bài viết hẹn giờ.");
        }

        $this->info("Đã xuất bản {$count} bài viết.");
        return Command::SUCCESS;
    }
}