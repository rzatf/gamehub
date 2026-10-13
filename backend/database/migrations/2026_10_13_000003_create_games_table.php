<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('games', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->unsignedBigInteger('steam_appid')->nullable()->index(); // source id for price sync
            $table->text('description')->nullable();
            $table->string('developer')->nullable();
            $table->string('publisher')->nullable();
            $table->date('release_date')->nullable();
            $table->decimal('rating', 3, 1)->default(0);
            $table->unsignedInteger('rating_count')->default(0);
            $table->string('cover_image');               // card art (landscape)
            $table->string('portrait_image')->nullable(); // box art
            $table->string('hero_image')->nullable();     // wide key art
            $table->string('wide_image')->nullable();     // 460x215 header art
            $table->json('min_requirements')->nullable();
            $table->json('rec_requirements')->nullable();
            $table->json('screenshots')->nullable();
            $table->boolean('is_featured')->default(false);
            $table->unsignedInteger('sort_order')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('games');
    }
};
