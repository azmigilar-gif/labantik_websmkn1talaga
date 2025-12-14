<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('s_submenus', function (Blueprint $table) {
            $table->uuid('s_view_name_id')->nullable()->after('url');
            $table->uuid('s_model_key_id')->after('s_view_name_id');
            $table->uuid('s_redirect_to_id')->nullable()->after('s_model_key_id');
        });
    }

    public function down(): void
    {
        Schema::table('s_submenus', function (Blueprint $table) {
            $table->dropColumn(['view_name', 'model_key', 'redirect_to']);
        });
    }
};
