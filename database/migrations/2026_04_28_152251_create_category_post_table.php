<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('category_post', function (Blueprint $table) {
            $table->id();
            // 記事への参照。記事が消えたら紐付けも消す（cascadeOnDelete）
            $table->foreignId('post_id')->constrained()->cascadeOnDelete();
            // カテゴリへの参照。カテゴリが消えたら紐付けも消す
            $table->foreignId('category_id')->constrained()->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('category_post');
    }
};
