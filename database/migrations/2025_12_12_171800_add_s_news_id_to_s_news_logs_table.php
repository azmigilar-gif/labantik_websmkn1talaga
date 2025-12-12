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
        Schema::table('s_news_logs', function (Blueprint $table) {
            // Tambah kolom s_news_id setelah id
            $table->uuid('s_news_id')->after('id')->nullable(); // nullable dulu untuk data lama

            // Tambah foreign key
            $table->foreign('s_news_id')
                  ->references('id')
                  ->on('s_news')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('s_news_logs', function (Blueprint $table) {
            $table->dropForeign(['s_news_id']);
            $table->dropColumn('s_news_id');
        });
    }
};
