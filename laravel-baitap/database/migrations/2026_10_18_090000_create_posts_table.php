<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
public function up(): void
{
    Schema::create('posts', function (Blueprint $table) {
        $table->id();
        // Cột user_id liên kết với id của bảng users
        $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
        $table->string('slug');
        $table->string('title');
        $table->text('content');
        $table->timestamps();
    });
}

    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};