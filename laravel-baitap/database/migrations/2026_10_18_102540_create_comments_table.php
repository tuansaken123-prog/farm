<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
{
    Schema::create('comments', function (Blueprint $table) {
        $table->id();
        // Cột post_id liên kết với id của bảng posts
        $table->foreignId('post_id')->constrained('posts')->onDelete('cascade');
        // Cột user_id liên kết với id của bảng users
        $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
        $table->text('content');
        $table->timestamps();
    });
}

    public function down(): void
    {
        Schema::dropIfExists('comments');
    }
};