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
        Schema::create('s_news', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('title');
            $table->text('content');
            $table->uuid('created_by');
            $table->uuid('updated_by')->nullable();
            $table->uuid('s_category_id');
            $table->uuid('s_menu_id');
            $table->boolean('is_published')->default(true);
            $table->timestamps();

            $table->foreign('updated_by')->references('id')->on('core_users');
            $table->foreign('created_by')->references('id')->on('core_users');
            $table->foreign('s_category_id')->references('id')->on('s_categories');
            $table->foreign('s_menu_id')->references('id')->on('s_menus');
            $table->foreign('s_tag_id')->references('id')->on('s_tags');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('s__news');
    }
};
