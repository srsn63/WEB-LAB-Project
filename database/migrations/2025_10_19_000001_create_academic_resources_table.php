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
        Schema::create('academic_resources', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('category'); // course_material, syllabus, academic_calendar
            $table->text('description')->nullable();
            $table->string('file_url')->nullable();
            $table->string('external_link')->nullable();
            $table->string('course_code')->nullable();
            $table->string('semester')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('academic_resources');
    }
};
