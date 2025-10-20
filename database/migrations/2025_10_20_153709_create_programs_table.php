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
        Schema::create('programs', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // e.g., "Bachelor of Science in Computer Science and Engineering"
            $table->string('short_name'); // e.g., "B.Sc. CSE"
            $table->string('degree_type'); // undergraduate, postgraduate
            $table->string('duration'); // e.g., "4 Years"
            $table->integer('total_credits'); // e.g., 160
            $table->text('description'); // Long program description
            $table->text('objectives')->nullable(); // Program learning objectives
            $table->text('career_prospects')->nullable(); // Career opportunities after graduation
            $table->text('admission_requirements')->nullable(); // Eligibility and admission info
            $table->foreignId('program_coordinator_id')->nullable()->constrained('teachers')->nullOnDelete(); // Coordinator
            $table->boolean('is_active')->default(true);
            $table->integer('order')->default(0); // For sorting display
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('programs');
    }
};
