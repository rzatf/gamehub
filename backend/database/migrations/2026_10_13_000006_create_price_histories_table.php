<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('price_histories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('game_id')->constrained()->cascadeOnDelete();
            $table->foreignId('platform_id')->constrained()->cascadeOnDelete();
            $table->date('recorded_on');
            $table->decimal('normal_price', 12, 2);
            $table->decimal('final_price', 12, 2);
            $table->unsignedTinyInteger('discount_percent')->default(0);
            $table->timestamps();

            $table->unique(['game_id', 'platform_id', 'recorded_on']);
            $table->index(['game_id', 'recorded_on']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('price_histories');
    }
};
