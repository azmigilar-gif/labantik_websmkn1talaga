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
        Schema::create('s_contacts', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('address_1');
            $table->string('address_2')->nullable();
            $table->string('email')->nullable();
            $table->string('no_telp')->nullable();
            $table->uuid('s_menu_id')->nullable();
            $table->uuid('created_by');
            $table->uuid('updated_by')->nullable();
            $table->timestamps();

            $table->foreign('s_menu_id')->references('id')->on('s_menus')->onDelete('set null');
            $table->foreign('created_by')->references('id')->on('core_users');
            $table->foreign('updated_by')->references('id')->on('core_users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('s_contacts');
    }
};
