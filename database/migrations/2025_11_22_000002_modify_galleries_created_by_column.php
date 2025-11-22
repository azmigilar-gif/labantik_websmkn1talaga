<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     * Change created_by to varchar(36) to accept UUIDs.
     */
    public function up()
    {
        // Use raw SQL to avoid requiring doctrine/dbal for this simple change
        DB::statement("ALTER TABLE `galleries` MODIFY `created_by` VARCHAR(36) NULL");
    }

    /**
     * Reverse the migrations.
     * Revert created_by back to unsigned big integer.
     */
    public function down()
    {
        DB::statement("ALTER TABLE `galleries` MODIFY `created_by` BIGINT UNSIGNED NULL");
    }
};
