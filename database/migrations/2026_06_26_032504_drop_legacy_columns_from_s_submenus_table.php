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
        // 1. Drop columns from s_submenus
        Schema::table('s_submenus', function (Blueprint $table) {
            $table->dropColumn(['s_view_name_id', 's_model_key_id', 's_redirect_to_id']);
        });

        // 2. Drop legacy tables
        Schema::dropIfExists('s_view');
        Schema::dropIfExists('s_model_key');
        Schema::dropIfExists('s_redirect');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Re-create tables
        Schema::create('s_view', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name');
            $table->string('slug');
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        Schema::create('s_model_key', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name');
            $table->string('slug');
            $table->timestamps();
        });

        Schema::create('s_redirect', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name');
            $table->string('slug');
            $table->timestamps();
        });

        // Re-add columns
        Schema::table('s_submenus', function (Blueprint $table) {
            $table->uuid('s_view_name_id')->nullable()->after('url');
            $table->uuid('s_model_key_id')->nullable()->after('s_view_name_id');
            $table->uuid('s_redirect_to_id')->nullable()->after('s_model_key_id');
        });
    }
};
