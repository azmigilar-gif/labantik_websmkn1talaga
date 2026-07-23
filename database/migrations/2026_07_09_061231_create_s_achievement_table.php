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
        Schema::create('s_achievement', function (Blueprint $table) {
            $table->string('id', 36)->primary();
            $table->string('title');
            $table->string('category');
            $table->date('date');
            $table->string('winner_name');
            $table->string('winner_social')->nullable();
            $table->text('description');
            $table->string('photo')->nullable();
            $table->string('created_by')->nullable();
            $table->string('updated_by')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('s_achievement');
    }
};
