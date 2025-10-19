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
        Schema::create('batches', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique(); // e.g., 2k20, 2k21, etc.
            $table->integer('sort_order'); // extracted from name for sorting
            $table->timestamps();
        });

        // Seed initial batches
        DB::table('batches')->insert([
            ['name' => '2k20', 'sort_order' => 20, 'created_at' => now(), 'updated_at' => now()],
            ['name' => '2k21', 'sort_order' => 21, 'created_at' => now(), 'updated_at' => now()],
            ['name' => '2k22', 'sort_order' => 22, 'created_at' => now(), 'updated_at' => now()],
            ['name' => '2k23', 'sort_order' => 23, 'created_at' => now(), 'updated_at' => now()],
            ['name' => '2k24', 'sort_order' => 24, 'created_at' => now(), 'updated_at' => now()],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('batches');
    }
};
