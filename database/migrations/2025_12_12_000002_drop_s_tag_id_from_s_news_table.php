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
        Schema::table('s_news', function (Blueprint $table) {
            // Drop foreign key and column for s_tag_id
            if (Schema::hasColumn('s_news', 's_tag_id')) {
                $table->dropForeign(['s_tag_id']);
                $table->dropColumn('s_tag_id');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('s_news', function (Blueprint $table) {
            $table->uuid('s_tag_id')->nullable()->after('id');
            $table->foreign('s_tag_id')->references('id')->on('s_tags')->onDelete('set null');
        });
    }
};
