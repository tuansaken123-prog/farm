<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PostSeeder extends Seeder
{
    public function run(): void
    {
        $data = [];
        for ($i = 1; $i <= 10; $i++) {
            $data[] = [
                'user_id' => rand(1, 10),
                'slug' => 'bai-viet-so-' . $i,
                'title' => 'Bài viết số ' . $i,
                'content' => 'Nội dung bài viết số ' . $i,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('posts')->insert($data);
    }
}