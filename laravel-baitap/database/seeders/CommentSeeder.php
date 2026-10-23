<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CommentSeeder extends Seeder
{
    public function run(): void
    {
        $data = [];
        for ($i = 1; $i <= 10; $i++) {
            $data[] = [
                'post_id' => rand(1, 10),
                'user_id' => rand(1, 10),
                'content' => 'Bình luận số ' . $i,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('comments')->insert($data);
    }
}