<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $data = [];
        for ($i = 1; $i <= 10; $i++) {
            $data[] = [
                'name' => 'User ' . $i,
                'email' => "user{$i}@gmail.com",
                'password' => Hash::make('123456'),
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('users')->insert($data);
    }
}