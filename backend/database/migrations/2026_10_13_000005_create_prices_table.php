<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('prices', function (Blueprint $table) {
            $table->id();
            $table->foreignId('game_id')->constrained()->cascadeOnDelete();
            $table->foreignId('platform_id')->constrained()->cascadeOnDelete();
            $table->decimal('normal_price', 12, 2);
            $table->decimal('final_price', 12, 2);
            $table->unsignedTinyInteger('discount_percent')->default(0);
            $table->char('currency', 3)->default('IDR');
            $table->string('url')->nullable();
            $table->timestamp('fetched_at')->nullable();
            $table->timestamps();

            $table->unique(['game_id', 'platform_id']);
            $table->index(['final_price']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('prices');
    }
};
