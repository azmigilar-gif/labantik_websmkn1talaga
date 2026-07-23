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
        Schema::table('s_submenus', function (Blueprint $table) {
            $table->string('type')->default('custom')->after('url');
            $table->longText('content')->nullable()->after('type');
            $table->string('external_url')->nullable()->after('content');
            $table->string('module_name')->nullable()->after('external_url');

            // Mengubah s_model_key_id menjadi nullable agar opsional untuk tipe baru
            $table->uuid('s_model_key_id')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('s_submenus', function (Blueprint $table) {
            $table->dropColumn(['type', 'content', 'external_url', 'module_name']);
            $table->uuid('s_model_key_id')->nullable(false)->change();
        });
    }
};
