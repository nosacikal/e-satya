<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Drop the check constraint specifically for PostgreSQL
        // This constraint is automatically created by Laravel when using ->enum() in PGSQL
        DB::statement('ALTER TABLE submissions DROP CONSTRAINT IF EXISTS submissions_status_check');

        // Ensure column is string to allow any status including 'rejected'
        Schema::table('submissions', function (Blueprint $table) {
            $table->string('status')->default('submitted')->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Optional: restore the constraint if needed, but usually not recommended for string columns
    }
};
