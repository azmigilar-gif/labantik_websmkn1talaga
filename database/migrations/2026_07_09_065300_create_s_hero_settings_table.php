<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function run(): void
    {
        Schema::create('s_hero_settings', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('hero_title')->nullable();
            $table->text('hero_description')->nullable();
            $table->string('badge_1_title')->nullable();
            $table->string('badge_1_subtitle')->nullable();
            $table->string('badge_2_title')->nullable();
            $table->string('badge_2_subtitle')->nullable();
            $table->string('badge_3_title')->nullable();
            $table->string('badge_3_subtitle')->nullable();
            $table->string('trust_badge_1')->nullable();
            $table->string('trust_badge_2')->nullable();
            $table->string('trust_badge_3')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('s_hero_settings');
    }
};
