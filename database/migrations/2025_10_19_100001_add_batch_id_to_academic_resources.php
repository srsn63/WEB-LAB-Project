<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('academic_resources', function (Blueprint $table) {
            $table->foreignId('batch_id')->nullable()->after('id')->constrained('batches')->onDelete('cascade');
        });

        // Assign all existing resources to 2k21 batch (batch_id = 2)
        $batch2k21 = DB::table('batches')->where('name', '2k21')->first();
        if ($batch2k21) {
            DB::table('academic_resources')->update(['batch_id' => $batch2k21->id]);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('academic_resources', function (Blueprint $table) {
            $table->dropForeign(['batch_id']);
            $table->dropColumn('batch_id');
        });
    }
};
