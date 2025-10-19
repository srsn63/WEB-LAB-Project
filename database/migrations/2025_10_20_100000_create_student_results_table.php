<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('student_results', function (Blueprint $table) {
            $table->id();
            $table->string('student_id', 7); // Links to students.student_id
            $table->foreignId('course_id')->constrained('courses')->onDelete('cascade');
            $table->string('semester'); // 1-1, 1-2, etc.
            $table->string('exam_type')->default('final'); // midterm, final, quiz, assignment
            $table->decimal('marks_obtained', 5, 2)->nullable();
            $table->decimal('total_marks', 5, 2)->nullable();
            $table->string('grade', 5)->nullable(); // A+, A, A-, B+, etc.
            $table->decimal('grade_point', 3, 2)->nullable(); // 4.00, 3.75, etc.
            $table->text('remarks')->nullable();
            $table->timestamps();
            
            $table->foreign('student_id')->references('student_id')->on('students')->onDelete('cascade');
            $table->index(['student_id', 'semester']);
            $table->index(['course_id', 'semester']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('student_results');
    }
};
