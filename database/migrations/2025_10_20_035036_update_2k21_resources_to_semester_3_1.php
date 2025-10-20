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
        // Update all academic resources for 2k21 batch that don't have a semester set to 3-1
        DB::statement("
            UPDATE academic_resources 
            SET semester = '3-1'
            WHERE batch_id IN (SELECT id FROM batches WHERE name = '2k21')
            AND (semester IS NULL OR semester = '')
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Optionally revert the changes
        DB::statement("
            UPDATE academic_resources 
            SET semester = NULL
            WHERE batch_id IN (SELECT id FROM batches WHERE name = '2k21')
            AND semester = '3-1'
        ");
    }
};
