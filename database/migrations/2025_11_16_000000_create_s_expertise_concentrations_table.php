<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('s_expertise_concentrations', function (Blueprint $table) {
            $table->char('id', 36);
            $table->char('id_concentrations', 36);
            $table->text('description')->nullable();
            $table->timestamps();

            $table->primary('id');
            // foreign key to core_expertise_concentrations if exists
            if (Schema::hasTable('core_expertise_concentrations')) {
                $table->foreign('id_concentrations')->references('id')->on('core_expertise_concentrations')->onDelete('cascade');
            }
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('s_expertise_concentrations');
    }
};
