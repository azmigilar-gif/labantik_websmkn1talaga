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
            // Drop foreign key and column for s_tag_id
            if (Schema::hasColumn('s_news_logs', 's_menu_id')) {
                $table->dropForeign(['s_menu_id']);
                $table->dropColumn('s_menu_id');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('s_news_logs', function (Blueprint $table) {
            $table->uuid('s_menu_id')->nullable()->after('id');
            $table->foreign('s_menu_id')->references('id')->on('s_tags')->onDelete('set null');
        });
    }
};
