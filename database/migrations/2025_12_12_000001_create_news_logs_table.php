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
        Schema::create('s_news_logs', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('s_menu_id');
            $table->uuid('s_tags_id')->nullable();
            $table->timestamps();

            $table->foreign('s_menu_id')->references('id')->on('s_menus')->onDelete('cascade');
            $table->foreign('s_tags_id')->references('id')->on('s_tags')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('news_logs');
    }
};
